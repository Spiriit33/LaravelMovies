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
        Route::get('/genres/{id}',['App\Http\Controllers\Api\MoviesController','getByGenre']);
    });
    Route::prefix('/series/')->group(function () {
        Route::get('/popular',['App\Http\Controllers\Api\SeriesController','getPopular']);
        Route::get('/rated',['App\Http\Controllers\Api\SeriesController','getTopRated']);
        Route::get('/{id}',['App\Http\Controllers\Api\SeriesController','show']);
    });
    Route::prefix('/acteurs/')->group(function () {
        Route::get('page/{page}',['App\Http\Controllers\Api\ActorsController','getPopular']);
        Route::prefix('show/{id}')->group(function () {
            Route::get('',['App\Http\Controllers\Api\ActorsController','show']);
            Route::get('/external_ids',['App\Http\Controllers\Api\ActorsController','getExternalIds']);
            Route::get('/combined_credits',['App\Http\Controllers\Api\ActorsController','getCombinedCredits']);
        });
    });
    Route::prefix('/genres/')->group(function () {
        Route::get('/films/list',['App\Http\Controllers\Api\GenreController','getMoviesList']);
        Route::get('/series/list',['App\Http\Controllers\Api\GenreController','getSeriesList']);
    });
    Route::prefix('/users/')->group(function () {
        Route::post('/create',['App\Http\Controllers\Api\UserController','store']);
        Route::prefix('/favorites')->group(function () {
            Route::prefix('/{id}')->group(function () {
                Route::put('add',['App\Http\Controllers\Api\MoviesController','addFavorite']);
            });
        });
    });
});
