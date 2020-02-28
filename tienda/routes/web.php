<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('vendedores/{vendedor}/showVentas', 'VendedorController@showVentas')->name('vendedores.ventas');

Route::resource("articulos", "ArticuloController");
Route::resource("categorias", "CategoriaController");
Route::resource("vendedores", "VendedorController");
