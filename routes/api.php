<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('registro', 'Auth\AuthenticatorController@register');
Route::post('login', 'Auth\AuthenticatorController@login');
Route::post('logout', 'Auth\AuthenticatorController@logout');

Route::prefix('media')->group(function() {
    Route::get('', 'Qualifiers\MediaController@index');
});

Route::prefix('country')->group(function() {
    Route::get('', 'Qualifiers\CountryController@index');
});

Route::prefix('category')->group(function() {
    Route::get('', 'Qualifiers\CategoryController@index');
});

Route::prefix('producer')->group(function() {
    Route::post('/store', 'Cast\ProducerController@store');
});

Route::prefix('cast')->group(function() {
    Route::post('/store', 'Cast\CastController@store');
});


Route::prefix('title')->group(function() {
    Route::get('/titles-page/{channel}/{page}/{pp}/{is_movie}', 'TitleController@titlesPage');
    Route::post('/store', 'TitleController@store');
});
