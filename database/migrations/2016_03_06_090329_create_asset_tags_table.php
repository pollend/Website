<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetTagsTable extends Migration {

	public function up()
	{
		Schema::create('asset_tags', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('asset_id')->unsigned()->index();
			$table->integer('tag_id')->unsigned()->index();
		});
	}

	public function down()
	{
		Schema::drop('asset_tags');
	}
}