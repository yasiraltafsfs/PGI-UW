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
Route::middleware('auth')->group(function () {
Route::prefix('payments')->group(function() {
    Route::get('/', 'PaymentController@index')->name('methods');
    Route::get('/refunds', 'RefundController@index')->name('refunds');
    Route::get('/create/refund{id}', 'RefundController@store')->name('create-refund');
    Route::get('/transactions', 'TransactionController@index')->name('transactions');
    Route::get('/transactions/create/charge', 'TransactionController@create')->name('transactions-create');
    Route::post('/create/charge', 'TransactionController@store')->name('create-charge');
    Route::get('/create/method', 'PaymentController@showAddPaymentMethodForm')->name('create-method');
    Route::post('/create/method', 'PaymentController@addPaymentMethod')->name('add-method');
    Route::get('/remove/method/{id}', 'PaymentController@removePaymentMethod')->name('remove-method');
    Route::get('/add-default/{id}', 'PaymentController@addDefault')->name('add-default');
    Route::get('/remove-default/{id}', 'PaymentController@removeDefault')->name('remove-default');

});
});
