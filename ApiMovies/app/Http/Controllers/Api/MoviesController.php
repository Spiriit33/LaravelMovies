<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    /**
     * Get popular movies.
     * @return array
     */
    public function getPopular(): array
    {
        return Http::withToken(config('tmdb.key'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json()['results'];
    }

    /**
     * Get movies who was currently playing.
     * @return array
     */
    public function getNowPlaying(): array
    {

        return Http::withToken(config('tmdb.key'))
            ->get('https://api.themoviedb.org/3/movie/now_playing')
            ->json()['results'];
    }

    /**
     * Get movies by genre.
     */
    public function getByGenre(int $id)
    {
        return Http::withToken(config('tmdb.key'))
            ->get('https://api.themoviedb.org/3/discover/movie?with_genres='.$id.'')
            ->json()['results'];
    }

    /**
     * Show movie details.
     * @param int $id
     * @return array
     */
    public function show(int $id): array
    {
        return Http::withToken(config('tmdb.key'))
            ->get('https://api.themoviedb.org/3/movie/' . $id . '?append_to_response=credits,videos,images')
            ->json();
    }

    /**
     * @param int $id
     */
    public function addFavorite(int $id)
    {
            $movie = Http::withToken(config('tmdb.key'))
            ->get('https://api.themoviedb.org/3/movie/' . $id . '')
            ->json();

            if (!$movie) {
                abort(404);
            }
            else {

            }
    }
}
