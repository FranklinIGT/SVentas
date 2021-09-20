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


/*AUTHENTIFICATION ROUTES*/
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@signup');
    Route::group(['middleware' => 'auth:api'], function() {
    Route::get('logout', 'AuthController@logout');
    Route::get('user', 'AuthController@user');
    });
});
/*AUTHENTIFICATION ROUTES*/

/*MIDDLEWARE GLOBAL*/
Route::group(['middleware'=>'auth:api'], function(){


    /*CATEGORY ROUTES*/
    Route::prefix('categorie')->group(function () {
        Route::post('/save','CategoryController@store');
        Route::get('/all','CategoryController@index' );
        Route::put('/edit','CategoryController@update' );
        Route::delete('/delete/{id}', 'CategoryController@destroy');
        Route::get('/CProducts','CategoryController@categorieProducts');
    });
    /*CATEGORY ROUTES*/

    /*PROVIDER ROUTES*/
    Route::prefix('provider')->group(function () {
        Route::post('/save','ProviderController@store');
        Route::get('/all','ProviderController@index' );
        Route::put('/edit','ProviderController@update' );
        Route::delete('/delete/{id}', 'ProviderController@destroy');
        Route::get('/PProducts','ProviderController@Providerprodutcs');

        });
    /*PROVIDER ROUTES*/

    /*PRODUCT ROUTES*/
    Route::prefix('product')->group(function () {
        Route::post('/save','ProductController@newProduct');
        Route::post('/addImage','ProductController@imageProduct');
        Route::put('/editProduct/{id}','ProductController@editProduct');
        Route::put('/editStock/{id}', 'ProductController@stockProduct');
        Route::get('/all', 'ProductController@allProducts');
        Route::post('/product/{id}', 'ProductController@product');
        Route::get('/imageProduct/{id}','ProductController@getImagesProduct');
        Route::delete('deleteProduct/{id}', 'ProductController@deleteProduct');
    });
    /*PRODUCT ROUTES*/

    /*ROL ROUTES*/
    Route::prefix('rol')->group(function(){

    Route::post('/addRol','RolController@addRol');

    });
    /*ROL ROUTES*/

});
/*MIDDLEWARE GLOBAL*/
