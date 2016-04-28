<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScreenshotsTable extends Migration {

	public function up()
	{
		Schema::create('screenshots', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->integer('image_id')->unsigned();
			$table->string('identifier', 10)->unique();
			$table->string('title', 100);
			$table->integer('like_count', 100);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('screenshots');
	}
}