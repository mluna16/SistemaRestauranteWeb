<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

//Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//Routas de la Api sistemasrestaurante/API/talMetodo
Route::group(['middleware' => 'auth','prefix' => 'API'], function(){
    //Rutas de productos
    Route::get('productoPorUsuario/{id}', ['uses' => 'productsController@getProductForUser']);
    Route::get('productoPorLocal/{id}', ['uses' => 'productsController@getProductForUser']);
    Route::get('productoInfo/{id}', ['uses' => 'productsController@show']);
    Route::get('productoInfo/{attr}/{id}', ['uses' => 'productsController@getProductsForAttrAndID']);


});
Route::group(['middleware' => 'auth','prefix' => 'admin'], function()
{
        Route::get('/','adminController@index');

        Route::get('Estadisticas','adminController@estadisticasIndex');

        Route::get('Usuarios','adminController@usuariosIndex');

        Route::get('Menu','adminController@menuIndex');

        Route::get('Restaurante','adminController@restauranteIndex');

        Route::resource('producto','productsController');
});

Route::group(['middleware' => 'auth','prefix' => 'caja'], function()
{
    Route::get('/','cajaController@index');

    Route::resource('pedido','pedidoController');


});

Route::resource('users','UserController');
Route::post('productImg/{id}', ['uses' => 'productImageController@postUpload', 'as' => 'imagenUpload']);




