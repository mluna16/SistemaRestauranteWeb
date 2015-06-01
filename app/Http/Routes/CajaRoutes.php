<?php
/**
 * Created by PhpStorm.
 * User: marcos
 * Date: 4/25/2015
 * Time: 12:09 PM
 *
 * Rutas para usar en el modulo de caja
 */

Route::group(['middleware' => 'auth','prefix' => 'caja'], function()
{
    Route::get('/','cajaController@index');
    Route::get('infoOrden/{id}','cajaController@getInfotable');
    Route::resource('pedido','pedidoController');
});