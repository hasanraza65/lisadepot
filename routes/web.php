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

Route::get('/', function () {
    return view('client.index');
});

/*
Route::get('/buy-service', function () {
    return view('client.services');
}); */

///////////////////
/* ADMIN ROUTES */
///////////////////

//service route
Route::resource('service', '\App\Http\Controllers\ServiceController');

///////////////////
/* CLIENT ROUTES */
///////////////////
Route::get('/buy-services', [App\Http\Controllers\ClientController::class, 'services']); 



