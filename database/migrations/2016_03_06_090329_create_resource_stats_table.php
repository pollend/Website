<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResourceStatsTable extends Migration {

	public function up()
	{
		Schema::create('resource_stats', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('resource_id')->unsigned()->index();
			$table->integer('stat_id')->unsigned();
			$table->decimal('value');
		});
	}

	public function down()
	{
		Schema::drop('resource_stats');
	}
}
