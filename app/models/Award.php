<?php

class Award extends Eloquent {

	protected $table = 'award';

    public function users()
    {
        return $this->belongsToMany('User', 'award_results');
    }

    public function lottery()
    {
        return $this->belongsTo('Lottery');
    }
}

?>