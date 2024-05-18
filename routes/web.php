<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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

// Route::group(['middleware'=>'admin'],function(){
//     Route::get('/', [LoginController::class, 'dashboard'])->name('dashboard');
// });
