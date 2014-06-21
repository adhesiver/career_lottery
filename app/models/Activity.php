<?php

class Activity extends Eloquent {

	protected $table = 'activity';
	protected $primaryKey = 'OID';
	public $timestamps = false;

	public function attendants()
    {
        return $this->belongsToMany('User', 'activity_signup', 'activity_OID', 'Attendant_OID');
    }

    public function scopeDesc($query)
    {
        return $query->orderBy('OID','desc');
    }
}

?>