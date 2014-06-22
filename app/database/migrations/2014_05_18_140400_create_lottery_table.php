<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotteryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('lottery', function($table)
	    {
	        $table->increments('id');
	        $table->string('lottery_name');
	        $table->integer('consume_point');
	        $table->dateTime('start_time');
	        $table->dateTime('end_time');
	        $table->dateTime('announce_time');
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
		Schema::drop('lottery');
	}

}
