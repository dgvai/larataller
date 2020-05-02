<?php 
namespace DGvai\Larataller;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use DGvai\Larataller\Middleware\CanInstallMiddleware;

class LaratallerServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        $router->middlewareGroup('install', [CanInstallMiddleware::class]);
    }

    public function register()
    {
        $this->publishers();
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'larataller');
    }

    private function publishers()
    {
        $this->publishes([
            __DIR__.'/config/larataller.php' => config_path('larataller.php'),
        ], 'larataller');

        $this->publishes([
            __DIR__.'/resources/views' => base_path('resources/views/vendor/larataller'),
        ], 'larataller-views');
    }
}