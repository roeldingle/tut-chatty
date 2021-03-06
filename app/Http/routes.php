<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



// Route::controllers([
// 	'auth' => 'Auth\AuthController',
// 	'password' => 'Auth\PasswordController',
// ]);


Route::get('/',[
	'uses' => 'HomeController@index',
	'as' => 'home',
]);


/*
	Authentication
*/
Route::get('/register',[
	'uses' => 'AuthController@getRegister',
	'as' => 'auth.register',
	'middleware' => ['guest'],
]);

Route::post('/register',[
	'uses' => 'AuthController@postRegister',
	'middleware' => ['guest'],
]);

Route::get('/login',[
	'uses' => 'AuthController@getLogin',
	'as' => 'auth.login',
	'middleware' => ['guest'],
]);

Route::post('/login',[
	'uses' => 'AuthController@postLogin',
	'middleware' => ['guest'],
]);

Route::get('/logout',[
	'uses' => 'AuthController@getLogout',
	'as' => 'auth.logout',
]);

/*
	Search
*/

Route::get('/search',[
	'uses' => 'SearchController@getResults',
	'as' => 'search.results',
]);

/*
	User profile
*/

Route::get('/user/{username}',[
	'uses' => 'ProfileController@getProfile',
	'as' => 'profile.index',
]);

Route::get('/profile/edit',[
	'uses' => 'ProfileController@getEdit',
	'as' => 'profile.edit',
	'middleware' => ['auth'],
]);

Route::post('/profile/edit',[
	'uses' => 'ProfileController@postEdit',
	'middleware' => ['auth'],
]);


/*
	Friends
*/

Route::get('/friends',[
	'uses' => 'FriendController@getIndex',
	'as' => 'friend.index',
	'middleware' => ['auth'],
]);

Route::get('/friends/add/{username}',[
	'uses' => 'FriendController@getAdd',
	'as' => 'friend.add',
	'middleware' => ['auth'],
]);

Route::get('/friends/accept/{username}',[
	'uses' => 'FriendController@getAccept',
	'as' => 'friend.accept',
	'middleware' => ['auth'],
]);

Route::post('/friends/delete/{username}',[
	'uses' => 'FriendController@postDelete',
	'as' => 'friend.delete',
	'middleware' => ['auth'],
]);

/*
	Statuses
*/
Route::post('/status',[
	'uses' => 'StatusController@postStatus',
	'as' => 'status.post',
	'middleware' => ['auth'],
]);


Route::post('/status/{statusId}/reply',[
	'uses' => 'StatusController@postReply',
	'as' => 'status.reply',
	'middleware' => ['auth'],
]);

Route::get('/status/{statusId}/like',[
	'uses' => 'StatusController@getLike',
	'as' => 'status.like',
	'middleware' => ['auth'],
]);