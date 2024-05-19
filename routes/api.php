<?php

use App\Http\Controllers\Api\ApiManageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'api'], function() {
    Route::get('/get-categories', [ApiManageController::class, 'getCategories']);
    Route::post('/get-category-by-id', [ApiManageController::class, 'getCategoryById']);
});
