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



Route::resource('/admin/users',"UsersController");
Route::resource('/admin/espacios',"espacioController");
Route::resource('/admin/clientes',"clienteController");
Route::post('/contrato','indexController@contrato');

Route::resource('/admin',"adminController");


Route::get('/', function () {
    return view('welcome');
  
});





Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'indexController@index')->name('home');
Route::get('/', 'indexController@index')->name('index');



