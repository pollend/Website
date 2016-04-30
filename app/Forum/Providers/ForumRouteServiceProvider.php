<?php


namespace PN\Forum\Providers;


use Illuminate\Support\ServiceProvider;
use PN\Forum\Http\Controllers\API\ApiCategoryController;
use PN\Forum\Http\Controllers\API\ApiPostController;
use PN\Forum\Http\Controllers\API\ApiThreadController;
use PN\Forum\Http\Controllers\CategoryController;
use PN\Forum\Http\Controllers\PostController;
use PN\Forum\Http\Controllers\ThreadController;

class ForumRouteServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        \Route::group(['prefix' => 'forum', 'as' => 'forum.'], function () {

            \Route::group(['prefix' => 'api', 'as' => 'api.'], function () {
                // Categories
                \Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
                    \Route::get('/', ['as' => 'index', 'uses' => ApiCategoryController::class . '@index']);
                    \Route::post('/', ['as' => 'store', 'uses' => ApiCategoryController::class . '@store']);
                    \Route::get('{id}', ['as' => 'fetch', 'uses' => ApiCategoryController::class . '@fetch']);
                    \Route::delete('{id}', ['as' => 'delete', 'uses' => ApiCategoryController::class . '@destroy']);
                    \Route::patch('{id}/enable-threads',
                        ['as' => 'enable-threads', 'uses' => ApiCategoryController::class . '@enableThreads']);
                    \Route::patch('{id}/disable-threads',
                        ['as' => 'disable-threads', 'uses' => ApiCategoryController::class . '@disableThreads']);
                    \Route::patch('{id}/make-public', ['as' => 'make-public', 'uses' => ApiCategoryController::class . '@makePublic']);
                    \Route::patch('{id}/make-private', ['as' => 'make-private', 'uses' => ApiCategoryController::class . '@makePrivate']);
                    \Route::patch('{id}/move', ['as' => 'move', 'uses' => ApiCategoryController::class . '@move']);
                    \Route::patch('{id}/rename', ['as' => 'rename', 'uses' => ApiCategoryController::class . '@rename']);
                    \Route::patch('{id}/reorder', ['as' => 'reorder', 'uses' => ApiCategoryController::class . '@reorder']);
                });

                // Threads
                \Route::group(['prefix' => 'thread', 'as' => 'thread.'], function () {
                    \Route::get('/', ['as' => 'index', 'uses' => ApiThreadController::class . '@index']);
                    \Route::get('new', ['as' => 'index-new', 'uses' => ApiThreadController::class . '@indexNew']);
                    \Route::patch('new', ['as' => 'mark-new', 'uses' => ApiThreadController::class . '@markNew']);
                    \Route::post('/', ['as' => 'store', 'uses' => ApiThreadController::class . '@store']);
                    \Route::get('{id}', ['as' => 'fetch', 'uses' => ApiThreadController::class . '@fetch']);
                    \Route::delete('{id}', ['as' => 'delete', 'uses' => ApiThreadController::class . '@destroy']);
                    \Route::patch('{id}/restore', ['as' => 'restore', 'uses' => ApiThreadController::class . '@restore']);
                    \Route::patch('{id}/move', ['as' => 'move', 'uses' => ApiThreadController::class . '@move']);
                    \Route::patch('{id}/lock', ['as' => 'lock', 'uses' => ApiThreadController::class . '@lock']);
                    \Route::patch('{id}/unlock', ['as' => 'unlock', 'uses' => ApiThreadController::class . '@unlock']);
                    \Route::patch('{id}/pin', ['as' => 'pin', 'uses' => ApiThreadController::class . '@pin']);
                    \Route::patch('{id}/unpin', ['as' => 'unpin', 'uses' => ApiThreadController::class . '@unpin']);
                    \Route::patch('{id}/rename', ['as' => 'rename', 'uses' => ApiThreadController::class . '@rename']);
                });

                // Posts
                \Route::group(['prefix' => 'post', 'as' => 'post.'], function ($r) {
                    \Route::get('/', ['as' => 'index', 'uses' => ApiPostController::class . '@index']);
                    \Route::post('/', ['as' => 'store', 'uses' => ApiPostController::class . '@store']);
                    \Route::get('{id}', ['as' => 'fetch', 'uses' => ApiPostController::class . '@fetch']);
                    \Route::delete('{id}', ['as' => 'delete', 'uses' => ApiPostController::class . '@destroy']);
                    \Route::patch('{id}/restore', ['as' => 'restore', 'uses' => ApiPostController::class . '@restore']);
                    \Route::patch('{id}', ['as' => 'update', 'uses' => ApiPostController::class . '@update']);
                });

                // Bulk actions
                \Route::group(['prefix' => 'bulk', 'as' => 'bulk.'], function () {
                    // Threads
                    \Route::group(['prefix' => 'thread', 'as' => 'thread.'], function () {
                        \Route::delete('/', ['as' => 'delete', 'uses' => ApiThreadController::class . '@bulkDestroy']);
                        \Route::patch('restore', ['as' => 'restore', 'uses' => ApiThreadController::class . '@bulkRestore']);
                        \Route::patch('move', ['as' => 'move', 'uses' => ApiThreadController::class . '@bulkMove']);
                        \Route::patch('lock', ['as' => 'lock', 'uses' => ApiThreadController::class . '@bulkLock']);
                        \Route::patch('unlock', ['as' => 'unlock', 'uses' => ApiThreadController::class . '@bulkUnlock']);
                        \Route::patch('pin', ['as' => 'pin', 'uses' => ApiThreadController::class . '@bulkPin']);
                        \Route::patch('unpin', ['as' => 'unpin', 'uses' => ApiThreadController::class . '@bulkUnpin']);
                    });

                    // Posts
                    \Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
                        \Route::patch('/', ['as' => 'update', 'uses' => ApiPostController::class . '@bulkUpdate']);
                        \Route::delete('/', ['as' => 'delete', 'uses' => ApiPostController::class . '@bulkDestroy']);
                        \Route::patch('restore', ['as' => 'restore', 'uses' => ApiPostController::class . '@bulkRestore']);
                    });
                });
            });

            \Route::group(['middleware' => ['web']], function(){

                \Route::get('/', ['as' => 'index', 'uses' => CategoryController::class . '@index']);


                \Route::get('new', ['as' => 'index-new', 'uses' => ThreadController::class . '@indexNew']);
                \Route::patch('new', ['as' => 'mark-new', 'uses' => ThreadController::class . '@markNew']);

                \Route::group(['prefix' => '{category}/{category_slug}'], function () {
                    \Route::get('/',
                        ['as' => 'category.index', 'uses' => CategoryController::class . '@show']);
                    \Route::get('thread/create',
                        ['as' => 'thread.create', 'uses' => ThreadController::class . '@create']);
                    \Route::get('{thread}/{thread_slug}/post/{post}',
                        ['as' => 'post.show', 'uses' => PostController::class . '@show']);
                    \Route::get('{thread}/{thread_slug}/reply',
                        ['as' => 'post.create', 'uses' => PostController::class . '@create']);
                    \Route::get('{thread}/{thread_slug}/post/{post}/edit',
                        ['as' => 'post.edit', 'uses' => PostController::class . '@edit']);
                    \Route::get('{thread}/{thread_slug}',
                        ['as' => 'thread.show', 'uses' => ThreadController::class . '@show']);
                });

                \Route::post('category/create',
                    ['as' => 'category.store', 'uses' => CategoryController::class . '@store']);
                \Route::patch('category/{category}',
                    ['as' => 'category.update', 'uses' => CategoryController::class . '@update']);
                \Route::delete('category/{category}',
                    ['as' => 'category.delete', 'uses' => CategoryController::class . '@destroy']);
                \Route::post('category/{category}/thread/create',
                    ['as' => 'thread.store', 'uses' => ThreadController::class . '@store']);
                \Route::patch('thread/{thread}',
                    ['as' => 'thread.update', 'uses' => ThreadController::class . '@update']);
                \Route::delete('thread/{thread}',
                    ['as' => 'thread.delete', 'uses' => ThreadController::class . '@destroy']);
                \Route::post('thread/{thread}/reply',
                    ['as' => 'post.store', 'uses' => PostController::class . '@store']);
                \Route::patch('post/{post}',
                    ['as' => 'post.update', 'uses' => PostController::class . '@update']);
                \Route::delete('post/{post}',
                    ['as' => 'post.delete', 'uses' => PostController::class . '@destroy']);

// Bulk actions
                \Route::group(['prefix' => 'bulk', 'as' => 'bulk.'], function () {
                    \Route::patch('thread',
                        ['as' => 'thread.update', 'uses' => ThreadController::class . '@bulkUpdate']);
                    \Route::delete('thread',
                        ['as' => 'thread.delete', 'uses' => ThreadController::class . '@bulkDestroy']);
                    \Route::patch('post',
                        ['as' => 'post.update', 'uses' => PostController::class . '@bulkUpdate']);
                    \Route::delete('post',
                        ['as' => 'post.delete', 'uses' => PostController::class . '@bulkDestroy']);
                });
            });
        });

    }
}