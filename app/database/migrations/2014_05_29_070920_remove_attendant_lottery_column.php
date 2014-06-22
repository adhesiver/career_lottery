<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveAttendantLotteryColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//		
		Schema::table('attendant_lottery', function($table)
		{
		    $table->dropColumn('receive');
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
		Schema::table('attendant_lottery',function($table){
			$table->integer('receive');
		});
	}

}
