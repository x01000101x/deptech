<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth:sanctum'], function () {

    //Admin
    Route::get('/admin', [AdminController::class, 'show']);
    Route::get('/admin/{id}', [AdminController::class, 'showById']);
    Route::post('/admin', [AdminController::class, 'create']);
    Route::put('/admin/{id}', [AdminController::class, 'update']);
    Route::delete('/admin/{id}', [AdminController::class, 'delete']);

    //Kategori
    Route::get('/admin/kategori', [KategoriController::class, 'show']);
    Route::get('/admin/kategori/{id}', [KategoriController::class, 'showById']);
    Route::post('/admin/kategori', [KategoriController::class, 'create']);
    Route::put('/admin/kategori/{id}', [KategoriController::class, 'update']);
    Route::delete('/admin/kategori/{id}', [KategoriController::class, 'delete']);

    //Produk
    Route::get('/admin/produk', [ProdukController::class, 'show']);
    Route::get('/admin/produk/{id}', [ProdukController::class, 'showById']);
    Route::post('/admin/produk', [ProdukController::class, 'create']);
    Route::post('/admin/produk/edit/{id}', [ProdukController::class, 'update']);
    Route::delete('/admin/produk/{id}', [ProdukController::class, 'delete']);

    //Transaction
    Route::get('/admin/transaction', [TransactionController::class, 'show']);
    Route::get('/admin/transaction/{id}', [TransactionController::class, 'showById']);
    Route::post('/admin/transaction', [TransactionController::class, 'create']);


    //Logout Admin
    Route::get('/admin/logout', [AuthController::class, 'logout']);
});
//Auth admin
Route::post('/admin/register', [AuthController::class, 'register']);
Route::post('/admin/login', [AuthController::class, 'login']);
