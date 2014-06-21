<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActivitySignupColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('activity_signup',function($table){

			$table->integer('point_validate')->default(0);
			$table->integer('get_point')->default(0);
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
		Schema::table('activity_signup', function($table)
		{
		    $table->dropColumn('point_validate');
		    $table->dropColumn('get_point');
		});
	}

}
