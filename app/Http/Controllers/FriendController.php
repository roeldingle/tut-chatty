<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;

class FriendController extends Controller {

	public function getIndex(){

		$friends = \Auth::user()->friends();
		$requests = \Auth::user()->friendRequests();

		return view('friends.index')
			->with('friends', $friends)
			->with('requests', $requests);
	}


	public function getAdd($username){

		$user = User::where('username', $username)->first();

		if(!$user){
			return redirect()
			->route('home')
			->with('info', 'That user could not be found');
		}

		if(\Auth::user()->hasFriendRequestsPending($user) || $user->hasFriendRequestsPending(\Auth::user())){

			return redirect()
			->route('profile.index', ['username' => $user->username])
			->with('info', 'Friend request already pending');
		}

		if(\Auth::user()->isFriendsWith($user)){

			return redirect()
			->route('profile.index', ['username' => $user->username])
			->with('info', 'You are already friends');
		}


		\Auth::user()->addFriend($user);

		return redirect()
			->route('profile.index', ['username' => $user->username])
			->with('info', 'Friend request sent.');

	}


	public function getAccept($username){

		$user = User::where('username', $username)->first();

		if(!$user){
			
			return redirect()
			->route('home')
			->with('info', 'That user could not be found');
		}

		if(!\Auth::user()->hasFriendRequestReceived($user)){

			return redirect()
			->route('home');
		}

		\Auth::user()->acceptFriendRequest($user);

		return redirect()
			->route('profile.index', ['username' => $user->username])
			->with('info', 'Friend request accepted.');

	}


	public function postDelete($username){
		
		$user = User::where('username', $username)->first();
		
		/*user is not friends with*/
		if(!\Auth::user()->isFriendsWith($user)){
			return redirect()->back();
		}

		/*delete*/
		\Auth::user()->deleteFriend($user);
		return redirect()
			->back()
			->with('info', 'Friend deleted.');
	}

}
