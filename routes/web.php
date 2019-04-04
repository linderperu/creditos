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
    return view('auth/login');
});
Route::resource('mantenimiento/clientes', 'ClienteController');
Route::resource('mantenimiento/roles', 'RolController');
Route::resource('mantenimiento/interes', 'InteresController');
Route::resource('mantenimiento/empleado','EmpleadoController');
Route::resource('procesos/caja','CajaController');
Route::resource('procesos/credito','CreditoController');
Route::resource('procesos/cobro','CobroController');
Route::resource('procesos/ingresos','DetallecajaController');
Route::resource('procesos/egresos','EgresoController');
Route::resource('procesos/reportes','ReportesController');
Auth::routes();

Route::get('/procesos/caja', 'CajaController@index')->name('caja');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

//Route::get('procesos/caja','CajaController@generatePDF');