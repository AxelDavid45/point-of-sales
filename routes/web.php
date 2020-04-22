<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('products', 'ProductController')->middleware('auth');
Route::resource('clients', 'ClientController')->middleware('auth');
Route::resource('sales', 'SaleController')->middleware('auth');
Route::get('/reports/sales', 'SaleController@export')->name('reports.sales')
    ->middleware('auth');
