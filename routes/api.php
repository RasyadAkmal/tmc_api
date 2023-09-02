<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;

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

Route::middleware('api_key')->group(function () {
    Route::post('categories', [CategoryController::class, 'store']);
    Route::post('products', [ProductController::class, 'store']);
    Route::get('search', [SearchController::class, 'index']);
});

Route::middleware('noauth')->group(function () {
    Route::post('test/categories', [CategoryController::class, 'store']);
    Route::post('test/products', [ProductController::class, 'store']);
    Route::get('test/search', [SearchController::class, 'index']);
});