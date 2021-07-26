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

Route::namespace('Api')->group(function(){
    Route::get('/apartment', 'ApartmentController@index');
    Route::get('/apartment/{address}', 'ApartmentController@search');
    Route::get('/service', 'ServiceController@service');
    Route::get('/apartment/advancedSearch/{address}&{radius}&{rooms}&{beds}&{services}', 'ApartmentController@advancedSearch');
    Route::get('/apartment={slug}', 'ApartmentController@show');
    Route::post('/messageSubmit', 'MessageController@send');
    Route::get('/sponsoredApartments', 'ApartmentController@index');
});
