<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
$controller_path = 'App\Http\Controllers';
Route::post('/login', $controller_path . '\API\UserController@login')->name('login');
//Route::get('/register', $controller_path . '\API\UserController@register')->name('register');


Route::middleware('auth:sanctum')->group(function ()
{
    Route::post('/customer-login','App\Http\Controllers\API\UserController@customerlogin');
});
