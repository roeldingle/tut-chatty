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

		$this->validate($request, [
			'username' => 'required|unique:users|alpha_dash|max:60',
			'email' => 'required|unique:users|email|max:255',
			'fname' => 'required|alpha_dash|max:60',
			'lname' => 'required|alpha_dash|max:60',
			'gender' => 'required',
		]);


		$created = User::saveUserMeta($request, \Auth::user()->id);

		if($created){
			return redirect()
			->route('home')
			->with('info','New user created successfully!');
		}
		
	}

}
