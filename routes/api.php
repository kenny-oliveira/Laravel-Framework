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

/*
Route::get('aula','AulaController@index');
Route::post('aula','AulaController@novaAula');
*/

Route::post('debts','debtscontroller@create');
Route::get('debts','debtscontroller@readAll');
Route::delete('debts/{id}','debtscontroller@Delete');
Route::put('debts/{id}','debtscontroller@Update');
Route::post('create','debtscontroller@create');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
