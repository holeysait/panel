<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

// Ensure alias for 'admin' middleware (no Kernel edits needed)
app('router')->aliasMiddleware('admin', AdminMiddleware::class);

Route::group([
    'middleware' => ['web', 'auth', 'admin'],
    'prefix' => 'admin',
    'as' => 'admin.',
], function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Users
    Route::resource('users', \App\Http\Controllers\Admin\UsersController::class);

    // Locations
    Route::resource('locations', \App\Http\Controllers\Admin\LocationsController::class);

    // Tariffs
    Route::resource('tariffs', \App\Http\Controllers\Admin\TariffsController::class);

    // Addons
    Route::resource('addons', \App\Http\Controllers\Admin\AddonsController::class);

    // Servers (read-only basic management)
    Route::get('servers', [\App\Http\Controllers\Admin\ServersController::class, 'index'])->name('servers.index');
    Route::get('servers/{server}', [\App\Http\Controllers\Admin\ServersController::class, 'show'])->name('servers.show');
    Route::patch('servers/{server}', [\App\Http\Controllers\Admin\ServersController::class, 'update'])->name('servers.update');

    // Promotions
    Route::resource('promotions', \App\Http\Controllers\Admin\PromotionsController::class);

    // Notifications (campaigns)
    Route::resource('notifications', \App\Http\Controllers\Admin\NotificationsController::class);

    // News
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);

    // Wiki
    Route::resource('wiki', \App\Http\Controllers\Admin\WikiController::class);

    // Pages
    Route::resource('pages', \App\Http\Controllers\Admin\PagesController::class);

    // Logs
    Route::get('logs', [\App\Http\Controllers\Admin\LogsController::class, 'index'])->name('logs.index');

    // Settings (single form)
    Route::get('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');
});
