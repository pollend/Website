<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForumAttachmentsTable extends Migration {

	public function up()
	{
		Schema::create('forum_attachments', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('post_id')->unsigned();
			$table->string('filename', 100);
			$table->string('source', 100);
			$table->integer('downloads');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('forum_attachments');
	}
}