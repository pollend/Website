<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagsTable extends Migration {

	public function up()
	{
		Schema::create('tags', function(Blueprint $table) {
			$table->increments('id');
			$table->string('type', 10);
			$table->string('tag', 20);
			$table->string('slug', 20);
			$table->string('parkitect_type', 30)->nullable();
			$table->boolean('primary')->default(0);
		});
	}

	public function down()
	{
		Schema::drop('tags');
	}
}