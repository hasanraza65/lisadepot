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



Route::get('/client-progress', function () {
    return view('admin.progress.index');
});

/*
Route::get('/buy-service', function () {
    return view('client.services');
}); */




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index']);

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
    Route::GET('/clientaccounts',[\App\Http\Controllers\ClientAccountController::class, 'ClientAccounts']);
    Route::POST('/filter-progress',[\App\Http\Controllers\ClientProgressController::class, 'filterProgress']);

    //Purchase service route 
    Route::resource('purchase-service', '\App\Http\Controllers\ClientPurchaseController');
    Route::GET('/hire-va',[\App\Http\Controllers\ClientPurchaseController::class, 'viewHireVA']);
    Route::GET('/all-hired-va',[\App\Http\Controllers\ClientPurchaseController::class, 'allHiredVA']);

    ///////////////////
    /* STRIPE ROUTES */
    ///////////////////

    Route::get('stripe/{purchaseid}', [App\Http\Controllers\StripeController::class, 'stripe']);
    Route::post('stripe', [App\Http\Controllers\StripeController::class, 'stripePost'])->name('stripe.post');


    ///////////////////
    /* Auto Charge ROUTES */
    ///////////////////
    Route::get('hour_based_charge', [App\Http\Controllers\AutoChargeController::class, 'perHourCharge']);
    Route::get('month_based_charge', [App\Http\Controllers\AutoChargeController::class, 'perMonthCharge']);


    ///////////////////
    /* Transactions ROUTES */
    ///////////////////
    Route::resource('/transactions', '\App\Http\Controllers\TransactionController');

    ///////////////////
    /* Custom Charge Customer */
    ///////////////////
    Route::get('chargecustomer', [App\Http\Controllers\StripeController::class, 'customChargeView']);
    Route::post('chargecustomer', [App\Http\Controllers\StripeController::class, 'chargeCustomer']);

    Route::get('clientpurchase', [App\Http\Controllers\StripeController::class, 'clientPurchase']);

});
