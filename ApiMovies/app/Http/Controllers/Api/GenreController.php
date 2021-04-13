<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class GenreController extends Controller
{
    /**
     * Get genres movies list.
     * @return array
     */
    public function getMoviesList(): array
    {
        return Http::withToken(config('tmdb.key'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];
    }

    /**
     * Get genres series list.
     * @return array
     */
    public function getSeriesList(): array
    {
        return Http::withToken(config('tmdb.key'))
            ->get('https://api.themoviedb.org/3/genre//list')
            ->json()['genres'];
    }
}
