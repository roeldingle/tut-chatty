<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

use Request;
use DB;

class User extends Model implements AuthenticatableContract{

	use Authenticatable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['role_id','username', 'email', 'password','is_active'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];



	/*
		Users meta relationship with pivot table
	*/
	public function meta()
    {
        return $this->belongsToMany('App\Models\Meta','meta_user','user_id','meta_id')->withPivot('value');
    }


    public static function saveUserMeta($request, $user){

    	
        $user->role_id = 2;
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->is_active = true;
        $user->save();
        

        if($request->input('fname') && $request->input('lname') && $request->input('gender')){
            $user->meta()->attach([ 1 => ['value'=>$request->input('fname')]]);
            $user->meta()->attach([ 2 => ['value'=>$request->input('lname')]]);
            $user->meta()->attach([ 3 => ['value'=>$request->input('gender')]]);
            $user->meta()->attach([ 4 => ['value'=>$request->input('avatar')]]);
        }
        

        //Check if user was created
		if ( ! $user->id)
		{
		    App::abort(500, 'Some Error');
		}

		//User was created show OK message
		return true;
    }


    public static function getAllUserMeta(){

    	$users = User::get()->map(function($user){
            foreach($user->meta as $meta) {
                $user->setAttribute($meta->key ,$meta->pivot['value']);
            }
            unset($user->meta);
            return $user;
        });

        return $users;
    }

    public static function getUserMeta($where){

    	$users = User::where($where['key'], $where['value'])->get()->map(function($user){
            foreach($user->meta as $meta) {

                $value = (!$meta->pivot['value']) ? '' : $meta->pivot['value'];
                $user->setAttribute($meta->key ,$value);
            }
            unset($user->meta);
            return $user;
        });

        return $users;
    }

     public function getFullName(){

        $where = array(
            'key' => 'id',
            'value' => $this->id
        );
        
     	$user = $this->getUserMeta($where)->first();

    	if($user->fname && $user->lname){
    		return "{$user->fname} {$user->lname}";
    	}else{
    		return "{$user->username}";
    	}

    }

    public static function getSearch($query){

        $users = User::where('username', 'LIKE', "%{$query}%")
        ->get();

        return $users;

    }

    public function getAvatarUrl(){

        //return "https://www.gravatar.com/avatar/{{md5($this->email)}}?d=mm&s=60";
        return $this->meta()->where('meta_id', '4')->first()->pivot['value'];
        
    }

     public function getAvatarUrlById($user_id){

        $user = User::findOrFail($user_id);

        if(!$return = $user->meta()->where('meta_id', '4')->first()->pivot['value']){
            return "https://www.gravatar.com/avatar/{{md5($this->email)}}?d=mm&s=60";
        }

        return $return;
    }

    /*
        Users statuses relationship
    */
    public function statuses()
    {
        return $this->hasMany('App\Models\Status','user_id');
    }


    /*
        Friends
    */

    public function friendsOfMine(){

        return $this->belongsToMany('App\Models\User', 'friends', 'user_id', 'friend_id' );
    }

    public function friendOf(){

        return $this->belongsToMany('App\Models\User', 'friends', 'friend_id', 'user_id' );
    }

    public function friends(){

        return $this->friendsOfMine()->wherePivot('accepted', true)->get()->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }

    public function friendRequests(){
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsPending(){
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestsPending(User $user){

        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user){
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user){
        return $this->friendOf()->attach($user->id);
    }

    public function acceptFriendRequest(User $user){
        return $this->friendRequests()->where('id', $user->id)->first()->pivot->update([ 'accepted' => true, ]);
    }

    public function isFriendsWith(User $user){

        return (bool) $this->friends()->where('id', $user->id)->count();
    }




}


