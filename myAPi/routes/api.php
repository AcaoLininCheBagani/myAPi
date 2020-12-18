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


    //Route::post('/login','MedPointController@login');



    //Route::post('/create','MedController@create')->name('api.jwt.create');

//our route
// Route::group(['middleware' => ['api'] ,'prefix' => '/registers'], function () {

    //Route::post('/create','MedController@create')->name('api.jwt.register');
    //Route::get('/','MedController@read');
    //Route::post('/create','MedController@create');

//     Route::put('/update/{id}', 'MedController@update');
//     Route::delete('/delete/{id}','MedController@delete');
//     Route::get('/view/{email}', 'MedController@view');
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['middleware' => ['jwt.auth']], function () {

// });
Route::post('/register','MedPointController@register')->name('api.jwt.register');
Route::post('/login','MedPointController@login')->name('api.jwt.login');

Route::get('unauthorized', function() {
    return response()->json([
        'status' => 'error',
        'message' => 'Unauthorized'
    ], 401);
})->name('api.jwt.unauthorized');

Route::group(['middleware' => 'auth:api'], function(){
    //logout
    Route::get('logout', 'MedPointController@logout')->name('api.jwt.logout');
    //get auth user
    Route::get('user', 'MedPointController@user')->name('api.jwt.user');
    //update
    Route::put('update/{id}', 'MedPointController@update')->name('api.jwt.update');
});


