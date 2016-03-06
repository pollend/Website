<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDownloadsTable extends Migration {

	public function up()
	{
		Schema::create('downloads', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned()->nullable();
			$table->integer('downloadable_id')->unsigned();
			$table->string('downloadable_type', 100);
			$table->string('ip');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('downloads');
	}
}