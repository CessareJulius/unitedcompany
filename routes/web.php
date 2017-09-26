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

Route::resource('/admin/proyectos',"proyectoController");
Route::get('test','EmailController@expiration');
Route::get('admin/membership/delete/{id}',"membershipController@delete")->name('admin.membership.delete');
Route::get('admin/membersip/suspend/{id}',"membershipController@suspend")->name('admin.membership.suspend');
Route::get('admin/membersip/unsuspend/{id}',"membershipController@unsuspend")->name('admin.membership.unsuspend');
Route::post('admin/membersip/extend/{id}',"membershipController@extend")->name('admin.membership.extend');
Route::post('admin/membersip/store/{id}',"membershipController@store")->name('admin.membresia.store');
Route::resource('/admin/clientes',"clienteController");
Route::get('/admin/payments',"paymentController@index")->name('admin.payments.index');
Route::get('/admin/payments/confirmar/{id}',"paymentController@confirmar")->name('admin.payments.confirmar');
Route::delete('/admin/payments/confirmar/{id}',"paymentController@destroy")->name('admin.payments.destroy');

//ClientArea
Route::get('/clientarea',"clientareaController@index")->name('clientarea.index');


//ClientArea Membership
Route::get('/clientarea/membership',"clientarea\membershipController@index")->name('clientarea.membership.index');
Route::get('/clientarea/membership/create',"clientarea\membershipController@create")->name('clientarea.membership.create');
Route::get('/clientarea/membership/store/{id}',"clientarea\membershipController@store")->name('clientarea.membership.store');

//Clientarea proyectos

Route::get('/clientarea/proyectos',"clientarea\proyectoController@index")->name('clientarea.proyectos.index');


Route::get('/clientarea/proyectos/create',"clientarea\proyectoController@create")->name('clientarea.proyectos.create');

Route::post('/clientarea/proyectos/',"clientarea\proyectoController@store")->name('clientarea.proyectos.store');

Route::get('/clientarea/proyectos/{id}/edit',"clientarea\proyectoController@edit")->name('clientarea.proyectos.edit');

Route::patch('/clientarea/proyectos/{id}',"clientarea\proyectoController@update")->name('clientarea.proyectos.update');


Route::delete('/clientarea/proyectos/{id}/destroy',"clientarea\proyectoController@destroy")->name('clientarea.proyectos.destroy');

Route::get('/clientarea/proyectos/{id}',"clientarea\proyectoController@show")->name('clientarea.proyectos.show');
//Payments
Route::get('/clientarea/payments/create',"clientarea\paymentController@create")->name('clientarea.payment.create');
Route::get('/clientarea/payments/store/{id}',"clientarea\paymentController@store")->name('clientarea.payment.store');
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



