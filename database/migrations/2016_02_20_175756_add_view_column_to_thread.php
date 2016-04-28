<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddViewColumnToThread extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forum_threads', function(Blueprint $table){
            $table->integer('views')->after('locked');
            $table->dropColumn('view_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forum_threads', function(Blueprint $table){
            $table->dropColumn('views');
            $table->integer('view_count');
        });
    }
}
