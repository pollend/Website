<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLikesTable extends Migration
{

    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('likeable_id')->unsigned();
            $table->string('likeable_type', 100);
            $table->smallInteger('weight')->unsigned()->default('1');
            $table->timestamps();

            $table->unique(['user_id', 'likeable_id', 'likeable_type']);
        });
    }

    public function down()
    {
        Schema::drop('likes');
    }
}