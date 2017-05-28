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
Route::get('/', function () {
    return view('welcome');
  
});




Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');



