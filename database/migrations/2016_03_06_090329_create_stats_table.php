<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStatsTable extends Migration {

	public function up()
	{
		Schema::create('stats', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 100);
			$table->string('title', 100)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('stats');
	}
}