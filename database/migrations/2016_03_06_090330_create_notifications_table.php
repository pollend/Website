<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('type', 100);
			$table->text('context');
			$table->boolean('read');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}