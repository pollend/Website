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
			$table->foreign('image_id')->references('id')->on('images')
						->onDelete('restrict')
						->onUpdate('no action');
		});
		Schema::table('asset_images', function(Blueprint $table) {
			$table->foreign('asset_id')->references('id')->on('assets')
						->onDelete('cascade')
						->onUpdate('no action');
			$table->foreign('image_id')->references('id')->on('images')
						->onDelete('cascade')
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
		Schema::table('resource_stats', function(Blueprint $table) {
			$table->foreign('resource_id')->references('id')->on('resources')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('resource_stats', function(Blueprint $table) {
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
		Schema::table('resources', function(Blueprint $table) {
			$table->foreign('image_id')->references('id')->on('images')
						->onDelete('restrict')
						->onUpdate('no action');
		});
		Schema::table('screenshots', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('screenshots', function(Blueprint $table) {
			$table->foreign('image_id')->references('id')->on('images')
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
			$table->foreign('image_id')->references('id')->on('images')
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
			$table->dropForeign('assets_buildoff_id_foreign');
		});
		Schema::table('asset_images', function(Blueprint $table) {
			$table->dropForeign('asset_images_asset_id_foreign');
		});
		Schema::table('asset_images', function(Blueprint $table) {
			$table->dropForeign('asset_images_image_id_foreign');
		});
		Schema::table('asset_dependencies', function(Blueprint $table) {
			$table->dropForeign('asset_dependencies_asset_id_foreign');
		});
		Schema::table('asset_dependencies', function(Blueprint $table) {
			$table->dropForeign('asset_dependencies_dependency_id_foreign');
		});
		Schema::table('resource_stats', function(Blueprint $table) {
			$table->dropForeign('resource_stats_resource_id_foreign');
		});
		Schema::table('resource_stats', function(Blueprint $table) {
			$table->dropForeign('resource_stats_stat_id_foreign');
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
		Schema::table('resources', function(Blueprint $table) {
			$table->dropForeign('resources_image_id_foreign');
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
	}
}