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

Route::get('/client-progress', function () {
    return view('admin.progress.index');
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

Route::resource('/client-progress', '\App\Http\Controllers\ClientProgressController');

///////////////////
/* CLIENT ROUTES */
///////////////////
Route::get('/buy-services', [App\Http\Controllers\ClientController::class, 'services']); 

Route::resource('/client-account', '\App\Http\Controllers\ClientAccountController');




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
