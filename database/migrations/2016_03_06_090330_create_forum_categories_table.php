<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForumCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('forum_categories', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('category_id')->unsigned();
			$table->string('title', 100);
			$table->text('description');
			$table->smallInteger('weight')->default('0');
			$table->boolean('enable_threads')->default(0);
			$table->boolean('private')->default(0);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('forum_categories');
	}
}