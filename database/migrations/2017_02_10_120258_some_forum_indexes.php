<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SomeForumIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("ALTER TABLE `forum_posts` ADD INDEX `thread_id` (`thread_id`);");
        DB::unprepared("ALTER TABLE `forum_categories` ADD INDEX `category_id` (`category_id`);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("ALTER TABLE `forum_posts` DROP INDEX `thread_id`;");
        DB::unprepared("ALTER TABLE `forum_categories` DROP INDEX `category_id`;");
    }
}
