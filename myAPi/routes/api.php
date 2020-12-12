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


    Route::post('/login','MedPointController@login');
    Route::post('/register','MedPointController@register');




//our route
Route::group(['middleware' => ['api'] ,'prefix' => '/registers'], function () {
    Route::get('/','MedController@read');
    Route::post('/create','MedController@create');
    Route::put('/update/{id}', 'MedController@update');
    Route::delete('/delete/{id}','MedController@delete');

});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['middleware' => ['jwt.auth']], function () {

// });
