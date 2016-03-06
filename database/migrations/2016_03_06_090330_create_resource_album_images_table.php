<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResourceAlbumImagesTable extends Migration {

	public function up()
	{
		Schema::create('resource_album_images', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('album_id')->unsigned();
			$table->integer('image_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('resource_album_images');
	}
}