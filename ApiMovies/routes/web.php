<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/api/1/')->group(function () {
    Route::prefix('/movies/')->group(function () {
        Route::get('/popular',['App\Http\Controllers\Api\MoviesController','getPopular']);
        Route::get('/now-playing',['App\Http\Controllers\Api\MoviesController','getNowPlaying']);
        Route::get('/{id}',['App\Http\Controllers\Api\MoviesController','show']);
    });
    Route::prefix('/genres/')->group(function () {
        Route::get('/films/list',['App\Http\Controllers\Api\GenreController','getMoviesList']);
        Route::get('/series/list',['App\Http\Controllers\Api\GenreController','getSeriesList']);
    });
    Route::get('/users/create',function () {
    });
});
