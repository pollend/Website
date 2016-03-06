<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('assets', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('no action');
		});
		Schema::table('assets', function(Blueprint $table) {
			$table->foreign('image_id')->references('id')->on('resource_images')
						->onDelete('restrict')
						->onUpdate('no action');
		});
		Schema::table('assets', function(Blueprint $table) {
			$table->foreign('album_id')->references('id')->on('albums')
						->onDelete('restrict')
						->onUpdate('no action');
		});
		Schema::table('assets', function(Blueprint $table) {
			$table->foreign('buildoff_id')->references('id')->on('buildoffs')
						->onDelete('restrict')
						->onUpdate('no action');
		});
		Schema::table('asset_dependencies', function(Blueprint $table) {
			$table->foreign('asset_id')->references('id')->on('assets')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('asset_dependencies', function(Blueprint $table) {
			$table->foreign('dependency_id')->references('id')->on('assets')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('asset_stats', function(Blueprint $table) {
			$table->foreign('asset_id')->references('id')->on('assets')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('asset_stats', function(Blueprint $table) {
			$table->foreign('stat_id')->references('id')->on('stats')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('asset_tags', function(Blueprint $table) {
			$table->foreign('asset_id')->references('id')->on('assets')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('asset_tags', function(Blueprint $table) {
			$table->foreign('tag_id')->references('id')->on('tags')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('buildoffs', function(Blueprint $table) {
			$table->foreign('tag_id')->references('id')->on('tags')
						->onDelete('set null')
						->onUpdate('no action');
		});
		Schema::table('buildoff_ranks', function(Blueprint $table) {
			$table->foreign('asset_id')->references('id')->on('assets')
						->onDelete('restrict')
						->onUpdate('no action');
		});
		Schema::table('buildoff_ranks', function(Blueprint $table) {
			$table->foreign('buildoff_id')->references('id')->on('buildoffs')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('comments', function(Blueprint $table) {
			$table->foreign('asset_id')->references('id')->on('assets')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('comments', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('likes', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('notifications', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('resource_album_images', function(Blueprint $table) {
			$table->foreign('album_id')->references('id')->on('albums')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('resource_album_images', function(Blueprint $table) {
			$table->foreign('image_id')->references('id')->on('resource_images')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('resource_blueprints', function(Blueprint $table) {
			$table->foreign('image_id')->references('id')->on('resource_images')
						->onDelete('restrict')
						->onUpdate('no action');
		});
		Schema::table('resource_mods', function(Blueprint $table) {
			$table->foreign('image_id')->references('id')->on('resource_images')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('resource_parks', function(Blueprint $table) {
			$table->foreign('image_id')->references('id')->on('resource_images')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('screenshots', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('screenshots', function(Blueprint $table) {
			$table->foreign('image_id')->references('id')->on('resource_images')
						->onDelete('restrict')
						->onUpdate('no action');
		});
		Schema::table('views', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('set null')
						->onUpdate('no action');
		});
		Schema::table('downloads', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('set null')
						->onUpdate('no action');
		});
		Schema::table('videos', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('videos', function(Blueprint $table) {
			$table->foreign('image_id')->references('id')->on('resource_images')
						->onDelete('restrict')
						->onUpdate('no action');
		});
		Schema::table('forum_categories', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('forum_categories')
						->onDelete('restrict')
						->onUpdate('no action');
		});
		Schema::table('threads', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('no action');
		});
		Schema::table('threads', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('forum_categories')
						->onDelete('restrict')
						->onUpdate('no action');
		});
		Schema::table('forum_posts', function(Blueprint $table) {
			$table->foreign('thread_id')->references('id')->on('threads')
						->onDelete('restrict')
						->onUpdate('no action');
		});
		Schema::table('forum_posts', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('no action');
		});
		Schema::table('forum_posts', function(Blueprint $table) {
			$table->foreign('post_id')->references('id')->on('forum_posts')
						->onDelete('restrict')
						->onUpdate('no action');
		});
		Schema::table('forum_thread_reads', function(Blueprint $table) {
			$table->foreign('thread_id')->references('id')->on('threads')
						->onDelete('restrict')
						->onUpdate('no action');
		});
		Schema::table('forum_thread_reads', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('no action');
		});
		Schema::table('forum_attachments', function(Blueprint $table) {
			$table->foreign('post_id')->references('id')->on('forum_posts')
						->onDelete('restrict')
						->onUpdate('no action');
		});
	}

	public function down()
	{
		Schema::table('assets', function(Blueprint $table) {
			$table->dropForeign('assets_user_id_foreign');
		});
		Schema::table('assets', function(Blueprint $table) {
			$table->dropForeign('assets_image_id_foreign');
		});
		Schema::table('assets', function(Blueprint $table) {
			$table->dropForeign('assets_album_id_foreign');
		});
		Schema::table('assets', function(Blueprint $table) {
			$table->dropForeign('assets_buildoff_id_foreign');
		});
		Schema::table('asset_dependencies', function(Blueprint $table) {
			$table->dropForeign('asset_dependencies_asset_id_foreign');
		});
		Schema::table('asset_dependencies', function(Blueprint $table) {
			$table->dropForeign('asset_dependencies_dependency_id_foreign');
		});
		Schema::table('asset_stats', function(Blueprint $table) {
			$table->dropForeign('asset_stats_asset_id_foreign');
		});
		Schema::table('asset_stats', function(Blueprint $table) {
			$table->dropForeign('asset_stats_stat_id_foreign');
		});
		Schema::table('asset_tags', function(Blueprint $table) {
			$table->dropForeign('asset_tags_asset_id_foreign');
		});
		Schema::table('asset_tags', function(Blueprint $table) {
			$table->dropForeign('asset_tags_tag_id_foreign');
		});
		Schema::table('buildoffs', function(Blueprint $table) {
			$table->dropForeign('buildoffs_tag_id_foreign');
		});
		Schema::table('buildoff_ranks', function(Blueprint $table) {
			$table->dropForeign('buildoff_ranks_asset_id_foreign');
		});
		Schema::table('buildoff_ranks', function(Blueprint $table) {
			$table->dropForeign('buildoff_ranks_buildoff_id_foreign');
		});
		Schema::table('comments', function(Blueprint $table) {
			$table->dropForeign('comments_asset_id_foreign');
		});
		Schema::table('comments', function(Blueprint $table) {
			$table->dropForeign('comments_user_id_foreign');
		});
		Schema::table('likes', function(Blueprint $table) {
			$table->dropForeign('likes_user_id_foreign');
		});
		Schema::table('notifications', function(Blueprint $table) {
			$table->dropForeign('notifications_user_id_foreign');
		});
		Schema::table('resource_album_images', function(Blueprint $table) {
			$table->dropForeign('resource_album_images_album_id_foreign');
		});
		Schema::table('resource_album_images', function(Blueprint $table) {
			$table->dropForeign('resource_album_images_image_id_foreign');
		});
		Schema::table('resource_blueprints', function(Blueprint $table) {
			$table->dropForeign('resource_blueprints_image_id_foreign');
		});
		Schema::table('resource_mods', function(Blueprint $table) {
			$table->dropForeign('resource_mods_image_id_foreign');
		});
		Schema::table('resource_parks', function(Blueprint $table) {
			$table->dropForeign('resource_parks_image_id_foreign');
		});
		Schema::table('screenshots', function(Blueprint $table) {
			$table->dropForeign('screenshots_user_id_foreign');
		});
		Schema::table('screenshots', function(Blueprint $table) {
			$table->dropForeign('screenshots_image_id_foreign');
		});
		Schema::table('views', function(Blueprint $table) {
			$table->dropForeign('views_user_id_foreign');
		});
		Schema::table('downloads', function(Blueprint $table) {
			$table->dropForeign('downloads_user_id_foreign');
		});
		Schema::table('videos', function(Blueprint $table) {
			$table->dropForeign('videos_user_id_foreign');
		});
		Schema::table('videos', function(Blueprint $table) {
			$table->dropForeign('videos_image_id_foreign');
		});
		Schema::table('forum_categories', function(Blueprint $table) {
			$table->dropForeign('forum_categories_category_id_foreign');
		});
		Schema::table('threads', function(Blueprint $table) {
			$table->dropForeign('threads_user_id_foreign');
		});
		Schema::table('threads', function(Blueprint $table) {
			$table->dropForeign('threads_category_id_foreign');
		});
		Schema::table('forum_posts', function(Blueprint $table) {
			$table->dropForeign('forum_posts_thread_id_foreign');
		});
		Schema::table('forum_posts', function(Blueprint $table) {
			$table->dropForeign('forum_posts_user_id_foreign');
		});
		Schema::table('forum_posts', function(Blueprint $table) {
			$table->dropForeign('forum_posts_post_id_foreign');
		});
		Schema::table('forum_thread_reads', function(Blueprint $table) {
			$table->dropForeign('forum_thread_reads_thread_id_foreign');
		});
		Schema::table('forum_thread_reads', function(Blueprint $table) {
			$table->dropForeign('forum_thread_reads_user_id_foreign');
		});
		Schema::table('forum_attachments', function(Blueprint $table) {
			$table->dropForeign('forum_attachments_post_id_foreign');
		});
	}
}