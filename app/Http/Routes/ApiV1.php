<?php
/**
 * Created by PhpStorm.
 * User: marcos
 * Date: 4/25/2015
 * Time: 12:07 PM
 *
 * Routas de la Api sistemasrestaurante/api/vX/talMetodo
 *
 */


/*
 * --Rutas que dependen de auth--
 */

Route::group(['middleware' => 'auth','prefix' => 'api/v1'], function(){


    /*
     * Rutas de productos
     */
    Route::group(['prefix' => 'Producto'],function(){
        Route::get('/', ['uses' => 'productsController@getProducts']);
        Route::get('Info/{id}', ['uses' => 'productsController@getProduct']);
        Route::get('Info/{attr}/{id}', ['uses' => 'productsController@getProductsForAttrAndID']);
    });



});

/*
 *  --Rutas para el auth--
 */
Route::controller('api/v1','Api\LoginController');


