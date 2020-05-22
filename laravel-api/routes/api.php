<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['middleware' => 'cors'],function(){
	Route::post('register','UserController@register');
	Route::post('login','UserController@login');
// });

Route::middleware('auth:api')->post('upload-file','FileController@receiveFile');
Route::middleware('auth:api')->get('list-products','FileController@listProducts');
Route::middleware('auth:api')->post('logout','UserController@logout');