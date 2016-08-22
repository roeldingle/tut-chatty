<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class FriendController extends Controller {

	public function getIndex(){

		$friends = \Auth::user()->friends();

		return view('friends.index')
			->with('friends', $friends);
	}

}
