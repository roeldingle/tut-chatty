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

	public function postEdit(){

		
	}

}
