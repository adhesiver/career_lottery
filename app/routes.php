<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	$user = User::where('StuID','=','101502518')->firstOrFail();
	//Auth::login($user);
	// dd(Auth::user()->Post);
	dd(get_class(Auth::user()));
	return View::make('hello');
});

Route::get('/test_lottery/{id}', function($id)
{
	$lottery = Lottery::find($id);
	//dd($lottery);
	//dd($lottery->awards->lists('award_name'));
	//$lottery->doLottery();
	//dd($lottery->getResult());
});

Route::resource('user', 'UserController');

Route::resource('activity','ActivityController');

Route::resource('lottery','LotteryController');

Route::resource('award','AwardController');

Route::get('login', array('as' => 'login', 'uses' => 'HomeController@login'));

Route::post('login', 'HomeController@do_Login');

Route::get('admin_login', array('as' => 'admin_login', 'uses' => 'HomeController@admin_login'));

Route::post('admin_login', 'HomeController@admin_do_Login');

Route::get('logout', 'HomeController@logout');

Route::get('joinlottery/{id}',array('as' => 'joinlottery', 'uses' => 'LotteryController@joinlottery'));

Route::get('dodolottery/{id}',array('as' => 'dodolottery', 'uses' => 'LotteryController@dodolottery'));

Route::get('showResult/{id}',array('as' => 'showResult', 'uses' => 'LotteryController@showResult'));