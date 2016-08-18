<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getResults(Request $request)
	{

		$query = $request->input('query');

		if(!$query){

			return redirect()->route('/');
		}

		$users = User::getSearch($query);

		return view('search.results',compact('users'));
	}



}
