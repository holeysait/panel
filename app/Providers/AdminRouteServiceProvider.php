<?php
namespace App\Providers;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class AdminRouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->booted(function () {
            /** @var Router $router */
            $router = $this->app['router'];
            // Register 'admin' middleware alias dynamically
            $router->aliasMiddleware('admin', \App\Http\Middleware\AdminMiddleware::class);
        });
    }
}