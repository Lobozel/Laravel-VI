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
    return view('index');
});
Route::get('vendedores/{vendedore}/showVentas', 'VendedorController@showVentas')->name('vendedores.ventas');
Route::get('articulos/{articulo}/vender', 'ArticuloController@vender')->name('articulos.vender');
Route::get('articulos/{articulo}/addStock', 'ArticuloController@addStock')->name('articulos.addstock');

Route::resource("articulos", "ArticuloController");
Route::resource("categorias", "CategoriaController");
Route::resource("vendedores", "VendedorController");

Route::post("vender", "ArticuloController@updateVenta")->name("articulos.updateVenta");
Route::post("addStock", "ArticuloController@updateStock")->name("articulos.updateStock");