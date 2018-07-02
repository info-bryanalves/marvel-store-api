<?php

use Illuminate\Http\Request;

Route::get('/marvel', 'API\MarvelController@getCharacters');
Route::apiResource('/payment', 'API\PaymentController');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
