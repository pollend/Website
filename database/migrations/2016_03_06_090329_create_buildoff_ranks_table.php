<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBuildoffRanksTable extends Migration {

	public function up()
	{
		Schema::create('buildoff_ranks', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('asset_id')->unsigned();
			$table->integer('buildoff_id')->unsigned();
			$table->integer('score')->default('0');
			$table->integer('rank');
		});
	}

	public function down()
	{
		Schema::drop('buildoff_ranks');
	}
}