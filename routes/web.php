<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WalletController;
use App\Http\Controllers\Api\PriceController;
use App\Http\Controllers\Api\EggImportController;
use App\Http\Controllers\Api\ServerController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/wallets/{wallet}/deposit', [WalletController::class, 'deposit']);
Route::get('/wallets/{wallet}/transactions', [WalletController::class, 'transactions']);
Route::get('/prices', [PriceController::class, 'index']);
Route::put('/prices/{price}', [PriceController::class, 'update']);
Route::post('/eggs/import', [EggImportController::class, 'import']);
Route::post('/servers', [ServerController::class, 'store']);

Route::get('/', function () {
    return view('welcome');
});

