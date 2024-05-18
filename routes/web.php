<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;

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

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/do-login', [LoginController::class, 'doLogin'])->name('do-login');

Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware'=>'admin.auth'],function(){
    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
    });
     Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
    });
});
