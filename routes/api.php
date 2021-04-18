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
    Route::get('/title/{title_id}', 'Cast\ProducerController@producerTitle');
    Route::post('/store', 'Cast\ProducerController@store')->middleware('can:isAdmin');
});

Route::prefix('cast')->group(function() {
    Route::get('/title/{title_id}', 'Cast\CastController@castTitle');
    Route::post('/store', 'Cast\CastController@store')->middleware('can:isAdmin');
});


Route::prefix('title')->group(function() {
    Route::get('/titles-page/{channel}/{page}/{pp}/{is_movie}', 'TitleController@titlesPage');
    Route::get('/comments/');
    Route::get('/media/{id}', 'TitleController@media' );
    Route::post('/store', 'TitleController@store')->middleware('can:isAdmin');
    Route::put('/update/{id}', 'TitleController@update')->middleware('can:isAdmin');

});
