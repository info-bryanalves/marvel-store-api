<?php

use Illuminate\Http\Request;

Route::get('/marvel/characters', 'API\MarvelController@getAll');
Route::post('/payment/register', 'API\PaymentController@register');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
