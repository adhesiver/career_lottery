<?php

class Lottery extends Eloquent{

	protected $table = 'lottery';

	public function lattendants()
    {
        $relation = $this->belongsToMany('User', DB::connection('mysql')->getDatabaseName().'.attendant_lottery', 'lottery_id', 'attendant_id');
        return $relation;
    }

    public function scopeTime($query)
    {
        return $query->orderBy('end_time','desc');
    }

    public function awards()
    {
    	return $this->hasMany('Award', 'lottery_id');
    }

    public function doLottery()
    {
    	$awards = $this->awards;
    	$lotteryList = $this->lattendants->lists('OID');
    	shuffle($lotteryList);
    	$len = count($lotteryList);
    	$pList = 0;
        $this->is_draw = 1;
        $this->save();
    	foreach ($awards as $award) {
    		$num = $award->num_of_people;
    		while($pList<$len && $num>0)
    		{
    			//$lottery->lattendants()->attach(Auth::user()->OID);
    			$this->lattendants->find($lotteryList[$pList])->awards()->attach($award->id);
    			$num--;
    			$pList++;
    		}
    	}
    }

    public function getResult()
    {
    	$awards = $this->awards;
    	$rtn = array();
    	foreach ($awards as $award) {
    		$rtn[$award->id] = array(
    			'name' => $award->award_name,
    			'users' => $award->users->lists('Name'),
    		);
    	}
    	return $rtn;
    }

}

?>