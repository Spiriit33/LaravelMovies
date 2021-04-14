<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    /**
     * Get all actors with pagination.
     * @param int $page
     * @return array
     */
    public function getPopular(int $page = 1): array
    {
        return Http::withToken(config('tmdb.key'))
            ->get('https://api.themoviedb.org/3/person/popular?page=' . $page)
            ->json();
    }

    /**
     * @param int $id
     * @return array
     */
    public function show(int $id): array
    {
        return Http::withToken(config('tmdb.key'))
            ->get('https://api.themoviedb.org/3/person/'.$id.'')
            ->json();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getExternalIds(int $id): array
    {
        return Http::withToken(config('tmdb.key'))
            ->get('https://api.themoviedb.org/3/person/' . $id . '/external_ids')
            ->json();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getCombinedCredits(int $id): array
    {
        return Http::withToken(config('tmdb.key'))
            ->get('https://api.themoviedb.org/3/person/' . $id . '/combined_credits')
            ->json();
    }
}
