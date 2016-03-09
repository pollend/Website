<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetsTable extends Migration {

	public function up()
	{
		Schema::create('assets', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->integer('image_id')->unsigned();
			$table->integer('album_id')->unsigned();
			$table->integer('buildoff_id')->unsigned()->nullable()->index();
			$table->integer('resource_id')->unsigned();
			$table->string('resource_type', 100);
			$table->string('identifier', 10)->unique();
			$table->string('type', 20);
			$table->string('name', 100);
			$table->string('slug', 100);
			$table->text('description');
			$table->string('youtube', 100);
			$table->float('hot_score');
			$table->integer('likes')->unsigned()->index()->default('0');
			$table->integer('views')->unsigned()->index()->default('0');
			$table->integer('downloads')->unsigned()->index()->default('0');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('assets');
	}
}
