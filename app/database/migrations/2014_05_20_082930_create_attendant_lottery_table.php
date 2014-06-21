<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendantLotteryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('attendant_lottery', function($table)
	    {
	        $table->increments('id');
	        $table->integer('attendant_id');
	        $table->integer('lottery_id');
	        $table->integer('receive');
	        $table->timestamps();
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('attendant_lottery');
	}

}
