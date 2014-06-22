<?php

// require_once $GLOBALS['laravel_paths']['base'].'app/models/pop3.class.php';

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function login()
	{	
		return View::make('login.index');
	}

	public function do_login()
	{
		$account = Input::get('account'); 
		$password = Input::get('password');

		$validator = Validator::make(array(
			'account' => $account,
			'password' => $password
			), array(
			'account' => 'required',
			'password' => 'required'
		));

		if ($validator->fails())
		{
		    return Redirect::route('login')->withErrors($validator);
		}

		// $pop3 = new POP3("cc.ncu.edu.tw");

		// if(($error = $pop3->Open()) == ""){
		// 	//計中email登入
		// 	if(($error = $pop3->Login($account, $password, 0)) == "")
		// 	{
		// 		$user = User::where('StuID','=',$account)->firstOrFail();
		// 		//dd($user);
		// 		Auth::login($user);
		// 		//dd(Auth::user());
		// 		//return Redirect::intended('lottery');							
		// 		return Redirect::route('lottery.index');							
		// 	}
		// 	else
		// 	{
		// 		return Redirect::route('login');
		// 	}
		// }
		// else
		// {										
		// 	return Redirect::route('login');
		// }	
		if(Auth::attempt(array('username'=>$account, 'password'=>$password)))
		{		
			if(!isset(Auth::user()->rule->user_id))
			{
				$id = Auth::user()->OID;
				$rule = new Rule;
				$rule->user_id = $id;
				$rule->save();
			}
			return Redirect::route('lottery.index');	
		}
		else
			return Redirect::route('login')->withErrors('帳號或密碼錯誤，或未報名參加過任一場活動');
	}

	public function admin_login()
	{	
		return View::make('login/admin_login');
	}

	public function admin_do_login()
	{
		$account = Input::get('account') ; 
		$password = Input::get('password');

		$validator = Validator::make(array(
			'account' => $account,
			'password' => $password
			), array(
			'account' => 'required',
			'password' => 'required'
		));

		if ($validator->fails())
		{
		    return Redirect::route('admin_login')->withErrors($validator);
		}
		// $pop3 = new POP3("cc.ncu.edu.tw");

		// if(($error = $pop3->Open()) == ""){
		// 	//計中email登入
		// 	if(($error = $pop3->Login($account, $password, 0)) == "")
		// 	{
		// 		$admin = Administrator::where('Account','=',$account)->firstOrFail();
		// 		Auth::login($admin);
		// 		return Redirect::intended('lottery');
		// 	}
		// 	else
		// 	{
		// 		return Redirect::route('admin_login');
		// 	}
		// }
		// else
		// {										
		// 	return Redirect::route('admin_login');
		// }	
		Session::put('is_admin', true);
		if(Auth::attempt(array('username'=>$account, 'password'=>$password)))
			return Redirect::route('lottery.index');	
		else
		{
			Session::forget('is_admin');
			return Redirect::route('admin_login')->withErrors('帳號或密碼錯誤');
		}
	}

	public function logout()
	{
		Auth::logout();
		Session::flush();
		return Redirect::route('lottery.index');
	}
}
