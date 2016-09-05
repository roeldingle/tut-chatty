<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;

class ProfileController extends Controller {

	public function getProfile($username){

		$users = User::where('username', $username)->get();

		if(!$users){
			abort(404);
		}


		return view('profile.index')
			->with('users',$users);

	}


	public function getEdit(){

		return view('profile.edit');
	}

	public function postEdit(Request $request){

		if(\Auth::user()->id){
            $user = User::findOrFail(\Auth::user()->id);
        }else{
            $user = new User();
        }


		$this->validate($request, [
			'username' => 'required|alpha_dash|max:60|unique:users,username,'.$user->id,
			'email' => 'required|email|max:255|unique:users,email,'.$user->id,
			'fname' => 'required|alpha_dash|max:60',
			'lname' => 'required|alpha_dash|max:60',
			'gender' => 'required',
		]);



		$created = User::saveUserMeta($request, $user);


		if($created){
			return redirect()
			->route('home')
			->with('info','New user created successfully!');
		}
		
	}

}
