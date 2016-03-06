<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResourceBlueprintsTable extends Migration {

	public function up()
	{
		Schema::create('resource_blueprints', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('image_id')->unsigned();
			$table->string('source', 100);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('resource_blueprints');
	}
}