<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::namespace('Api')->group(function(){
    Route::get('/apartment', 'ApartmentController@index');
    Route::get('/apartment/{address}', 'ApartmentController@search');
    Route::get('/service', 'ServiceController@service');
    Route::get('/apartment/advancedSearch/{address}&{radius}&{rooms}&{beds}&{services}', 'ApartmentController@advancedSearch');
    Route::get('/apartment={slug}', 'ApartmentController@show');
    Route::post('/messageSubmit', 'MessageController@send');
});


//rotte per braintree
Route::get('orders/generate', 'Api/Orders/OrderController@generate');

Route::post('orders/make/payment', 'Api/Orders/OrderController@makePayment');
