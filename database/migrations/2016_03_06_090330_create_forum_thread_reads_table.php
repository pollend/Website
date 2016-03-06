<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForumThreadReadsTable extends Migration {

	public function up()
	{
		Schema::create('forum_thread_reads', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('thread_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('forum_thread_reads');
	}
}