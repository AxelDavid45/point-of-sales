<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('charts/sales', 'SaleController@salesInAYear');
Route::get('charts/sales/month/{month}', 'SaleController@salesInThisMonth');
Route::get('charts/sales/day/{month}', 'SaleController@salesByDay');
