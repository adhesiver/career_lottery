<?php

class ActivityInfo extends Eloquent {

  protected $table = 'activity_info';

  public function activity()
  {
    return $this->hasOne('Activity', 'OID', 'activity_id');
  }

}
