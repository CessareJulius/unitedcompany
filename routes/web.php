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


Route::resource('/farmacos',"FarmacosController");
Route::resource('/inventario',"InventarioController");
Route::resource('/users',"UsersController");
Route::resource('/ingreso',"IngresoController");
Route::resource('/venta',"VentaController");
Route::get('/notification',"FCMController@notification");
Route::get('/', function () {
    return view('welcome');
  
});

Route::get('/ingreso/pdfDetalleIngreso/{id}','IngresoController@pdfDetalleIngreso');
Route::get('/ingreso/pdfDetalleVenta/{id}','VentaController@pdfDetalleVenta');





Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'indexController@index')->name('home');
Route::get('/', 'indexController@index');



