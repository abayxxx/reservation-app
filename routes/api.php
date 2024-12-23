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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Menu
Route::get('/menu', 'App\Http\Controllers\Admin\MenuController@getAll');

//Order
Route::post('/order', 'App\Http\Controllers\Admin\OrderController@storeOrder');

//Table 
Route::get('/table', 'App\Http\Controllers\Admin\TableController@getAll');
