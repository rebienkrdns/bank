<?php

use App\Http\Controllers\Bank\AccountController;
use App\Http\Controllers\Bank\HomeController;
use App\Http\Controllers\Bank\RootController;
use App\Http\Controllers\Bank\TransactionsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [RootController::class, 'index']);

Route::middleware(['auth'])->group(function () {
    Route::get('/inicio', [HomeController::class, 'index'])->name('login');
    Route::get('/transacciones-bancarias', [TransactionsController::class, 'index']);
    Route::get('/transacciones-bancarias/cuentas-propias', [TransactionsController::class, 'ownTransactions']);
    Route::post('/transacciones-bancarias/cuentas-propias', [TransactionsController::class, 'ownAccountTransaction']);
    Route::get('/transacciones-bancarias/cuentas-de-terceros', [TransactionsController::class, 'thirdPartyTransactions']);
    Route::post('/transacciones-bancarias/cuentas-de-terceros', [TransactionsController::class, 'thirdPartyAccountTransaction']);
    Route::get('/estado-de-la-cuenta', [AccountController::class, 'index']);
});

require __DIR__ . '/auth.php';
