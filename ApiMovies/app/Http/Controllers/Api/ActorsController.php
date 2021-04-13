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
    public function getAll(int $page = 1): array
    {
        return Http::withToken(config('tmdb.key'))
            ->get('https://api.themoviedb.org/3/person/popular?page='.$page)
            ->json()['results'];
    }
}
