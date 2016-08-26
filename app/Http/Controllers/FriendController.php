<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class FriendController extends Controller {

	public function getIndex(){

		$friends = \Auth::user()->friends();
		$requests = \Auth::user()->friendRequests();


		return view('friends.index')
			->with('friends', $friends)
			->with('requests', $requests);
	}

}
