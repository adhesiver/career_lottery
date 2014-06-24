<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	protected $primaryKey = 'OID';
  protected $connection = 'mysql_activity';
	public $timestamps = false;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'attendant';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return null;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return null;
	}

  public function setAttribute($key, $value)
  {
    $isRememberTokenAttribute = $key == $this->getRememberTokenName();
    if (!$isRememberTokenAttribute)
    {
      parent::setAttribute($key, $value);
    }
  }

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function belongActivity()
    {
        return $this->belongsToMany('Activity','activity_signup','activity_OID','attendant_OID');
    }

    public function belongLottery()
    {
        return $this->belongsToMany('Lottery', 'attendant_lottery', 'attendant_id','lottery_id' );
    }

    public function rule()
    {
    	return $this->hasOne('Rule');
    }

    public function awards()
    {
    	return $this->belongsToMany('Award', 'award_results');
    }

    public function isManager()
    {
    	//管理者權限
        return !($this->Admin < 1);
    }
    
    public function isJoin($lottery_id)
    {
    	//判斷使用者是否報名該次抽獎
    	return ($this->belongLottery()->where('lottery.id', '=', $lottery_id)->count() > 0) ? true : false;
    }
}
