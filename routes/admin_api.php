<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace'=>'Admin'], function() {

    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });

    Route::group(['namespace'=>'Auth'], function() {
        Route::controller(RegisterController::class)->group(function () {
            Route::post('register', 'register')->name('register');
        });
        Route::controller(LoginController::class)->group(function () {
            Route::post('login', 'login')->name('login');
            Route::middleware('auth:sanctum')->match(['GET', 'POST'],'logout', 'logout')->name('logout');
        });
    });
});
