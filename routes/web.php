<?php

use Illuminate\Support\Facades\Route;


$controller_path = 'App\Http\Controllers';

Route::get('/clear-cache', function() {
Artisan::call('cache:clear');
Artisan::call('config:cache');
return 'Application cache has been cleared';
});


Route::get('/', $controller_path . '\Dashboard@index')->name('index');
Route::get('/customers', $controller_path . '\CustomerController@index')->name('customers');
Route::get('/addcustomer', $controller_path . '\CustomerController@create')->name('customers/create');
Route::post('/customers/store', $controller_path . '\CustomerController@store')->name('customers/store');
Route::get('/transactions/{customer_id}', $controller_path . '\TransactionController@index')->name('transactions');
Route::get('/addtransaction/{customer_id}', $controller_path . '\TransactionController@create')->name('addtransactions');
Route::post('/transaction/store', $controller_path . '\TransactionController@store')->name('transactions/store');
