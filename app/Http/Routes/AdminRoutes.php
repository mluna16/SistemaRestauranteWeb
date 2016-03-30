<?php
/**
 * Created by PhpStorm.
 * User: marcos
 * Date: 4/25/2015
 * Time: 12:07 PM
 *
 * Rutas para usar en la Administracion
 */

Route::group(['middleware' => 'auth','prefix' => 'admin'], function()
{
    Route::get('modaluser','adminController@createUserModal');
    Route::get('modalmenu','adminController@createMenuModal');
    Route::get('/', 'adminController@estadisticasIndex');

    Route::get('Estadisticas', 'adminController@estadisticasIndex');

    Route::get('Usuarios', 'adminController@usuariosIndex');

    Route::get('Menu', 'adminController@menuIndex');

    Route::get('Restaurante', 'adminController@restauranteIndex');

    Route::post('productSoftDelete/{id}/{action}', ['uses' => 'productsController@softDelete', 'as' => 'productSoftDelete']);

    Route::resource('producto', 'productsController');

    Route::resource('local', 'localController');

    Route::group(['prefix' => 'Estadisticas'], function(){

        Route::get('producto/{time}', 'estadisticaController@getProductosVendidos');
        Route::get('mesonero/{time}', 'estadisticaController@getMesoneroVenta');
        Route::get('venta', 'estadisticaController@getVentaDia');
        Route::get('ventas', 'estadisticaController@getVentaSemana');
        Route::get('ventaa', 'estadisticaController@getVentaAno');



    });

});

Route::resource('users', 'UserController',['only' => ['store']]);

Route::group(['middleware' => 'auth','except' => 'UserController@store'], function() {

    Route::post('userSoftDelete/{id}', ['uses' => 'UserController@softDelete', 'as' => 'userSoftDelete']);
    Route::post('changePassword', ['uses' => 'UserController@changePassword', 'as' => 'userChangePassword']);
    Route::post('storeAjax', ['uses' => 'UserController@storeAjax', 'as' => 'userStoreAjax']);
    Route::resource('users', 'UserController',['except' => ['store']]);
    Route::post('admin/productImg/{id}', ['uses' => 'productImageController@postUpload', 'as' => 'imagenUpload']);
    Route::post('localImg', ['uses' => 'localImageController@postUpload', 'as' => 'localImagenUpload']);

});

