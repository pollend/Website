<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetStatsTable extends Migration {

	public function up()
	{
		Schema::create('asset_stats', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('asset_id')->unsigned()->index();
			$table->integer('stat_id')->unsigned();
			$table->string('value', 20)->default('0');
		});
	}

	public function down()
	{
		Schema::drop('asset_stats');
	}
}