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
Route::resource('/admin/reservas',"reservaController");


Route::resource('/admin/clientes',"clienteController");
Route::post('/admin/clientes/membresia/{id}',"clienteController@membresia")->name('clientes.membresia');
//ClientArea
Route::get('/clientarea',"clientareaController@index")->name('clientarea.index');


//ClientArea Membership
Route::get('/clientarea/membership',"clientarea\membershipController@index")->name('clientarea.membership.index');
Route::get('/clientarea/membership/create',"clientarea\membershipController@create")->name('clientarea.membership.create');
Route::get('/clientarea/membership/store/{id}',"clientarea\membershipController@store")->name('clientarea.membership.store');

//Payments
Route::get('/clientarea/payments/create',"clientarea\paymentController@create")->name('clientarea.payment.create');
Route::get('/clientarea/payments',"clientarea\paymentController@index")->name('clientarea.payment.index');
//\App\Helpers\RouteHelper::NamedResourceRoute('clientarea.membership', 'clientarea\membershipController', 'clientarea/membership');


Route::post('/contrato','indexController@contrato');

Route::resource('/admin',"adminController");


Route::get('/', function () {
    return view('welcome');
  
});





Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'indexController@index')->name('home');
Route::get('/', 'indexController@index')->name('index');



