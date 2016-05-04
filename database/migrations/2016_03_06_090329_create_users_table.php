<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('identifier', 10)->unique();
			$table->integer('level')->default(0);
			$table->string('name', 100)->nullable();
			$table->string('username', 100)->nullable();
			$table->string('email', 100);
			$table->string('password', 150);
			$table->string('password_token', 100)->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->string('confirm_token', 100)->nullable();
			$table->boolean('confirmed');
			$table->string('api_key', 100);
			$table->boolean('social');
			$table->string('social_id', 50);
			$table->string('social_name', 100);
			$table->boolean('notification_rate');
			$table->integer('recap_rate');
			$table->string('avatar', 100);
			$table->string('title', 50);
			$table->string('flair', 50)->nullable();
			$table->string('steam', 50)->nullable();
			$table->string('twitch', 50)->nullable();
			$table->string('twitter', 50)->nullable();
			$table->string('bitcoin', 100)->nullable();
			$table->string('paypal', 50)->nullable();
			$table->string('register_ip', 50)->nullable();
			$table->string('last_activity_ip', 50)->nullable();
			$table->datetime('last_activity')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}
