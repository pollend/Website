<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateViewsTable extends Migration {

	public function up()
	{
		Schema::create('views', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned()->nullable();
			$table->integer('viewable_id')->unsigned();
			$table->string('viewable_type', 100);
			$table->string('ip', 50);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('views');
	}
}