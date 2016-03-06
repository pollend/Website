<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResourceImagesTable extends Migration {

	public function up()
	{
		Schema::create('resource_images', function(Blueprint $table) {
			$table->increments('id');
			$table->string('source', 100);
		});
	}

	public function down()
	{
		Schema::drop('resource_images');
	}
}