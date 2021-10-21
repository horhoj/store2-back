<?php

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

Route::prefix('v1')->namespace('App\Http\Controllers\API')->group(function () {
    Route::namespace('auth')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::post('/register', 'RegisterController');
            Route::post('/login', 'LoginController');
        });
    });

    Route::middleware('auth:api')->group(function () {
        Route::namespace('auth')->group(function () {
            Route::prefix('auth')->group(function () {
                Route::get('/user', 'UserInfoController');
                Route::get('/logout', 'LogoutController');
            });
        });

        Route::apiResource('/products', 'ProductController');
        Route::apiResource('/categories', 'CategoryController');
        Route::apiResource('/contacts', 'ContactController');
    });
});
