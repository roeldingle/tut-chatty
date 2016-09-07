<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Status;
use Auth;

class StatusController extends Controller {

	public function postStatus(Request $request)
	{

		$this->validate( $request, [
			'status' => 'required|max:1000',
		]);


		Auth::user()->statuses()->create([
			'body' => $request->input('status'),
		]);

		return redirect()->route('home')->with('info', 'Status posted');

	}

	public function postReply(Request $request, $statusId){
		
		$this->validate( $request, [
			"reply-{$statusId}" => 'required|max:1000',
			],[
				'required' => 'The reply body is required.'
		]);


		$status = Status::notReply()->find($statusId);

		if(!$status){
			redirect()->route('home');
		}

		if(!Auth::user()->isFriendsWith($status->user) && Auth::user()->id !== $status->user->id){
			redirect()->route('home');
		}

		$reply = Status::create([
			'body' => $request->input("reply-{$statusId}")
		])->user()->associate(Auth::user());

		$status->replies()->save($reply);

		return redirect()->back();



	}


	

}