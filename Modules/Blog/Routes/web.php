<?php

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


use Modules\Blog\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '','middleware' => ['auth']], function() {
    Route::prefix('dashboard')->group(function(){

        Route::get('index', [BlogController::class, 'index']);
        Route::get('create_post', [BlogController::class, 'create_post']);
        Route::post('store_post', [BlogController::class, 'store_post']);
        Route::post('comment/{id}', [BlogController::class, 'comment']);
        Route::get('comments/{id}', [BlogController::class, 'comments']);
    });
});
