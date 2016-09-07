<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Status;
use App\Models\User;

class Status extends Model {

	protected $table = 'statuses';
	protected $fillable = [
		'body'
	];


	 /*
        Users statuses relationship
    */
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }


    public function scopeNotReply($query){

        return $query->whereNull('parent_id');
    }


    public function replies(){

        return $this->hasMany('App\Models\Status','parent_id');
    }

}
