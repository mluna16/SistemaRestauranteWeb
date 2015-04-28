<?php
/**
 * Created by PhpStorm.
 * User: marcos
 * Date: 4/25/2015
 * Time: 12:07 PM
 *
 * Routas de la Api sistemasrestaurante/API/talMetodo
 *
 */
Route::controller('api/v1','Auth\ApiController');

Route::group(['middleware' => 'auth','prefix' => 'api/v1'], function(){
    //Rutas de productos
    Route::get('productoPorUsuario/{id}', ['uses' => 'productsController@getProductForUser']);
    Route::get('productoPorLocal/{id}', ['uses' => 'productsController@getProductForLocal']);
    Route::get('productoInfo/{id}', ['uses' => 'productsController@show']);
    Route::get('productoInfo/{attr}/{id}', ['uses' => 'productsController@getProductsForAttrAndID']);


});

