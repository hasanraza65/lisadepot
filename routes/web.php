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

Route::get('/buy-service', function () {
    return view('client.services');
});

/*
Route::get('/services', function () {
    return view('admin.services.index');
});

Route::get('/services/create', function () {
    return view('admin.services.add');
});

Route::get('/services/edit', function () {
    return view('admin.services.edit');
}); */

//Route::get('/services', App\Http\Controllers\ServiceController::class);

        //...
        Route::resource('service', '\App\Http\Controllers\ServiceController');



