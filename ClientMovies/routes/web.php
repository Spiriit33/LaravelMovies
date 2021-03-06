<?php

use Illuminate\Support\Facades\Route;

Route::get('/register',['App\Http\Controllers\UserController','create']);

Route::get('/', 'MoviesController@index')->name('movies.index');
Route::get('/films/{id}', 'MoviesController@show')->name('movies.show');

Route::get('/series', 'TvController@index')->name('tv.index');
Route::get('/series/{id}', 'TvController@show')->name('tv.show');

Route::get('/acteurs', 'ActorsController@index')->name('actors.index');
Route::get('/acteurs/page/{page?}', 'ActorsController@index');

Route::get('/acteurs/{id}', 'ActorsController@show')->name('actors.show');
Route::get('/films/genres/{id}',['App\Http\Controllers\MoviesController','getByGenre'])->name('movies.genres');
