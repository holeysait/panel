<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ServersController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class,'showLogin'])->name('login');
    Route::post('/login', [AuthController::class,'login'])->name('login.post');
    Route::get('/register', [AuthController::class,'showRegister'])->name('register');
    Route::post('/register', [AuthController::class,'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');

    Route::get('/', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/servers', [ServersController::class,'index'])->name('servers.index');
    Route::get('/wallet', [WalletController::class,'index'])->name('wallet.index');

    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('/profile', [SettingsController::class, 'updateProfile'])->name('settings.updateProfile');
        Route::post('/password', [SettingsController::class, 'updatePassword'])->name('settings.updatePassword');
        Route::post('/locale', [SettingsController::class, 'updateLocale'])->name('settings.updateLocale');
    });
});
