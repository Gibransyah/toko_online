<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\OrderController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::middleware('auth:sanctum')->get('/admin', function (Request $request) {
//     return $request->admin();
// });

// Route::resource('barang', BarangController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/barang', [BarangController::class, 'index']);
Route::get('/barangs/{id', [BarangController::class, 'show']);
    

//protected routes
route::middleware('auth:sanctum')->group(function (){
    Route::resource('barangs', BarangController::class)->except('create', 'edit');
    Route::resource('alamats', AlamatController::class)->except('create', 'edit');
    Route::resource('orders', OrderController::class)->except('create', 'edit');
    Route::post('/logout', [AuthController::class, 'logout']);
});