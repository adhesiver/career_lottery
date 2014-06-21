<?php

class Rule extends Eloquent {

	protected $table = 'rule';

    public function user()
    {
        return $this->belongsTo('User','user_id');
    }
}

?>