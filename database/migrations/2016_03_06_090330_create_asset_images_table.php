<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetImagesTable extends Migration {

	public function up()
	{
		Schema::create('asset_images', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('asset_id')->unsigned();
			$table->integer('image_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('asset_images');
	}
}