<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;
use App\Models\User;

class AuthController extends Controller {

	public function getRegister(){

		return view('auth.register');
	}

	public function postRegister(Request $request){


		$this->validate($request, [
			'username' => 'required|unique:users|alpha_dash|max:60',
			'email' => 'required|unique:users|email|max:255',
			'password' => 'required|min:6',
			'password_confirmation' => 'required|min:6|same:password',
		]);

		$created = User::saveUserMeta($request);

		if($created){
			return redirect()
			->route('home')
			->with('info','New user created successfully!');
		}

       
	}


	public function getLogin(){

		return view('auth.login');
	}


	public function postLogin(Request $request){

		$this->validate($request, [
			'email' => 'required',
			'password' => 'required',
		]);

		if(!Auth::attempt($request->only(['email','password'], $request->has('remember')))){
			return redirect()
			->back()
			->with('info','Could not login!');
		}


		return redirect()
			->route('home')
			->with('info','You are now login!');

	}


	public function getLogout(){
		Auth::logout();
		return redirect()
			->route('home')
			->with('info','You are logout!');
	}

}
