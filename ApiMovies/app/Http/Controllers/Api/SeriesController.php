<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class SeriesController extends Controller
{
    /**
     * Get popular series.
     * @return array
     */
    public function getPopular(): array
    {
        return Http::withToken(config('tmdb.key'))
            ->get('https://api.themoviedb.org/3/tv/popular')
            ->json()['results'];
    }

    /**
     * Get top rated series.
     * @return array
     */
    public function getTopRated(): array
    {
        return Http::withToken(config('tmdb.key'))
            ->get('https://api.themoviedb.org/3/tv/top_rated')
            ->json()['results'];
    }
}
