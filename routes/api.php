<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('register', 'Auth\AuthenticatorController@register');
    Route::post('login', 'Auth\AuthenticatorController@login');
    
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', 'Auth\AuthenticatorController@logout');    
    });
});


//Route::middleware('auth:api')->group(function () {
    Route::resource('categories', 'CategoryController');
    Route::resource('products', 'ProductController');
    Route::resource('clients', 'ClientController');    
    Route::resource('shoppings', 'ShoppingController');        
//});
