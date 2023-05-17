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

Route::prefix('payments')->group(function() {
    Route::get('/', 'PaymentController@index')->name('methods');
    Route::get('/refunds', 'PaymentController@refunds')->name('refunds');
    Route::get('/transactions', 'PaymentController@transactions')->name('transactions');
    Route::get('/create/method', 'PaymentController@addPaymentMethod')->name('create-method');
    Route::post('/create/method', 'PaymentController@addPaymentMethod')->name('create-method');

});
