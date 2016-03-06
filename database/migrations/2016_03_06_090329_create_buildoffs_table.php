<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBuildoffsTable extends Migration {

	public function up()
	{
		Schema::create('buildoffs', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('tag_id')->unsigned()->nullable();
			$table->string('type_requirement', 50)->nullable();
			$table->string('name', 100);
			$table->string('short_description', 100)->nullable();
			$table->text('description')->nullable();
			$table->string('thumbnail', 100);
			$table->datetime('start');
			$table->datetime('end');
			$table->datetime('voting_start');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('buildoffs');
	}
}