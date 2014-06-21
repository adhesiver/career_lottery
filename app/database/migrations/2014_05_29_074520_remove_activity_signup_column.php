<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveActivitySignupColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//		
		Schema::table('activity_signup', function($table)
		{
		    $table->dropColumn('point_validate');
		    $table->dropColumn('get_point');
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
		Schema::table('activity_signup',function($table){
			$table->integer('point_validate');
			$table->integer('get_point');
		});
	}

}
