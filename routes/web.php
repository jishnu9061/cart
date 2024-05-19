<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
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
Route::get('/product-list', [CartController::class, 'productList'])->name('product');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('/cart', [CartController::class, 'getCart'])->name('get-cart');
Route::post('/do-login', [LoginController::class, 'doLogin'])->name('do-login');

Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware'=>'admin.auth'],function(){

    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::post('/logout', [LoginController::class, 'logOut'])->name('logout');

    // Category
    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
        Route::delete('/delete/{category}', [CategoryController::class, 'delete'])->name('delete');
        Route::put('/update/{category}', [CategoryController::class, 'update'])->name('update');
    });

    // Product
     Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
        Route::delete('/delete/{product}', [ProductController::class, 'delete'])->name('delete');
        Route::put('/update/{product}', [ProductController::class, 'update'])->name('update');
    });
});
