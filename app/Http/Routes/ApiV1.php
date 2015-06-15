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
    Route::group(['prefix' => 'producto'],function(){
        Route::get('/', ['uses' => 'productsController@getProducts']);
        Route::get('Info/{id}', ['uses' => 'productsController@getProduct']);
        Route::get('Info/{attr}/{id}', ['uses' => 'productsController@getProductsForAttrAndID']);
        Route::get('resetInventory',['uses' => 'productsController@resetInventory']);
    });

    Route::group(['prefix' => 'order'],function(){
        Route::post('store',['uses' => 'Api\OrderController@store']);
        Route::delete('delete/{id}',['uses' => 'Api\OrderController@destroy']);

    });

    Route::group(['prefix' => 'table'],function(){
        Route::get('/', ['uses' => 'Api\TableController@index']);
        Route::get('show/{id}', ['uses' => 'Api\TableController@show' , 'as' => 'showTable']);
        Route::get('getInvoice/{id}',['uses' => 'Api\TableController@getInvoice']);
    });

    Route::group(['prefix' => 'invoice'],function(){


    });



});

/*
 *  --Rutas para el auth--
 */
Route::controller('api/v1','Api\LoginController');


