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
        Route::get('extra', ['uses' => 'productsController@getExtraProducts']);
        Route::get('Info/{id}', ['uses' => 'productsController@getProduct']);
        Route::get('Info/{attr}/{id}', ['uses' => 'productsController@getProductsForAttrAndID']);
        Route::get('resetInventory',['uses' => 'productsController@resetInventory']);
    });
    Route::group(['prefix' => 'order'],function(){
        Route::post('store',['uses' => 'Api\OrderController@store']);
        Route::delete('delete/{id}',['uses' => 'Api\OrderController@destroy']);
        Route::put('edit/{id}',['uses' => 'Api\OrderController@update']);
        Route::get('/{status}',['uses' => 'Api\OrderController@getOrders']);
        Route::post('changeReady',['uses' => 'Api\OrderController@changeReady']);
        Route::post('returned',['uses' => 'Api\OrderController@returnedOrder']);
        Route::post('comentario',['uses' => 'Api\OrderController@addComentario']);
        Route::post('delete/comentario',['uses' => 'Api\OrderController@deleteComentario']);
    });

    Route::group(['prefix' => 'table'],function(){
        Route::get('/', ['uses' => 'Api\TableController@index']);
        Route::get('show/{id}', ['uses' => 'Api\TableController@show' , 'as' => 'showTable']);
        Route::get('show/', ['uses' => 'Api\TableController@showAll', 'as' => 'showAllTables']);
        Route::get('getInvoice/{id}',['uses' => 'Api\TableController@getInvoice']);
    });

    Route::group(['prefix' => 'invoice'],function(){


    });

    Route::group(['prefix' => 'user'],function(){
        Route::post('code', ['uses' => 'UserController@addCodigo']);
        Route::get('send', ['uses' => 'UserController@test']);
    });




    });

/*
 *  --Rutas para el auth--
 */
Route::controller('api/v1','Api\LoginController');


