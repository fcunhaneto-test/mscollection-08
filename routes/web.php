<?php

use App\Models\Qualifiers\Media;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    $c_media = new Media();
    $media = $c_media->streams();

    return view('auth.login', compact('media'));
})->name('login');

Route::get('/logout', function () {
    $c_media = new Media();
    $media = $c_media->streams();

    return view('auth.logout', compact('media'));
})->name('logout');

Route::get('/', function () {
    $media = new Media();
    $slug = $media->streams()->first()->slug;

    return redirect('/filmes/' . $slug);
});

Route::get('/filmes/{channel}', 'TitleController@start')->name('movies');
Route::get('/series/{channel}', 'TitleController@start')->name('series');
