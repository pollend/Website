<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetDependenciesTable extends Migration {

	public function up()
	{
		Schema::create('asset_dependencies', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('asset_id')->unsigned()->index();
			$table->integer('dependency_id')->unsigned();
			$table->unique(['asset_id', 'dependency_id']);
		});
	}

	public function down()
	{
		Schema::drop('asset_dependencies');
	}
}