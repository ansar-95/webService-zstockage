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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login', 'LoginController@authenticate')->name('Authenticate');

Route::apiResource('reservation', 'ReservationController') 
	->middleware('verify.propel.authentification');

Route::apiResource('bloc', 'BlocController') 
	->middleware('verify.propel.authentification');   

Route::apiResource('travee', 'TraveeController') 
	->middleware('verify.propel.authentification');  

Route::apiResource('pile', 'PileController') 
	->middleware('verify.propel.authentification');  

