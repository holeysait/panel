<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Apply user locale if present
        $user = Auth::user();
        if ($user && $user->locale) {
            app()->setLocale($user->locale);
        }

        // Ensure 'admin' middleware alias exists (avoids "Target class [admin] does not exist.")
        app('router')->aliasMiddleware('admin', \App\Http\Middleware\AdminMiddleware::class);

        // Auto-load admin routes file if present
        $adminRoutes = base_path('routes/admin.php');
        if (file_exists($adminRoutes)) {
            $this->loadRoutesFrom($adminRoutes);
        }
    }
}
