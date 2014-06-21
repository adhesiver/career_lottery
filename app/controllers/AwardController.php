<?php

// require_once $GLOBALS['laravel_paths']['base'].'app/models/pop3.class.php';

class AwardController extends BaseController {

	public function __construct() {
            $this->beforeFilter('csrf', array('on' => 'post'));
            $this->beforeFilter('manager');
    }

	public store()
	{
		$award = new Award();
		$award->name = Input::get('name');
		$award->num_of_people = Input::get('num_of_people');
	}
	
}
