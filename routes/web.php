<?php

use App\Http\Controllers\WEB\AdminController;
use App\Http\Controllers\WEB\KategoriController;
use App\Http\Controllers\WEB\ProductController;
use App\Http\Controllers\WEB\TransactionController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/admin', [AdminController::class, 'show']);
    Route::get('/kategori', [KategoriController::class, 'show']);
    Route::get('/produk', [ProductController::class, 'show']);
    Route::get('/transaksi', [TransactionController::class, 'show']);
});


require __DIR__ . '/auth.php';
