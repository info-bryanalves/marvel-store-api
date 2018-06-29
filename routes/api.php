<?php

use Illuminate\Http\Request;

Route::apiResource('/marvel', 'API\MarvelController');
Route::apiResource('/payment', 'API\PaymentController');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
