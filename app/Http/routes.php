<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//Api Controllers
Route::group(['prefix' => 'api/v1'], function(){
	
	
	Route::post('login', 'Auth\ApiController@login');
	Route::post('login-with-jwt', 'Auth\JWTAuthController@login');
    Route::get('me', 'Auth\JWTAuthController@profile');
	Route::resource('denuncias', 'DenunciasController');

});
