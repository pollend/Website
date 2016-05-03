<?php


namespace PN\Pages\Providers;


use Illuminate\Support\ServiceProvider;
use PN\Foundation\Providers\CompileHelperTrait;
use PN\Pages\Http\Controllers\PageController;
use PN\Pages\Repositories\PageRepository;
use PN\Pages\Repositories\PageRepositoryInterface;

class PageServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $router = $this->app['router'];

        $router->get('page/{slug}', [
            'uses' => PageController::class.'@show',
            'as' => 'pages.show'
        ]);

        $this->app->singleton(PageRepositoryInterface::class, PageRepository::class);
    }

    public static function compiles() {
        $files = [];

        $files = array_merge($files, CompileHelperTrait::filesInFolder(app_path('Pages/Providers')));

        return $files;
    }
}