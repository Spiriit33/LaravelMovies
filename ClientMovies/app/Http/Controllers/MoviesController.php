<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesSearch;
use Illuminate\Http\Request;
use App\ViewModels\MovieViewModel;
use App\ViewModels\MoviesViewModel;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class MoviesController extends Controller
{
    /**
     *
     */
    public function index() : View
    {
        $popularMovies = Http::get('http://127.0.0.1:8001/api/1/movies/popular')
            ->json();

        $nowPlayingMovies = Http::get('http://127.0.0.1:8001/api/1/movies/now-playing')
            ->json();

        $genres = Http::get('http://127.0.0.1:8001/api/1/genres/films/list')
            ->json();

        $genresNav = $genres;

        $viewModel = new MoviesViewModel(
            $popularMovies,
            $nowPlayingMovies,
            $genres
        );
        return view('movies.index', $viewModel,compact('genresNav'));
    }
    /**
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $movie = Http::get('http://127.0.0.1:8001/api/1/movies/' . $id . '')
            ->json();
        $suggestions = Http::get('http://127.0.0.1:8001/api/1/movies/genres/' . $movie['genres'][0]['id'] . '')
            ->json();

        $genres = Http::get('http://127.0.0.1:8001/api/1/genres/films/list')
            ->json();

        $genresNav = $genres;
        $viewModel = new MovieViewModel($movie,$suggestions,$genres);
        return view('movies.show', $viewModel,compact('genresNav'));
    }

    /**
     * @param int $id
     * @return View
     */
    public function getByGenre(int $id): View
    {
        $movies = Http::get('http://127.0.0.1:8001/api/1/movies/genres/'.$id.'')
        ->json();

        $genres = Http::get('http://127.0.0.1:8001/api/1/genres/films/list')
            ->json();

        $genresNav = $genres;

        $viewModel = new MoviesSearch($movies,$genres);
        return view('movies.search',$viewModel,compact('genresNav'));
    }
}
