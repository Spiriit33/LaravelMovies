<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\TvViewModel;
use App\ViewModels\TvShowViewModel;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index() : View
    {
        $popularTv = Http::get('http://127.0.0.1:8001/api/1/series/popular')
                    ->json();

        $topRatedTv = Http::get('http://127.0.0.1:8001/api/1/series/rated')
            ->json();

        $genres = Http::get('http://127.0.0.1:8001/api/1/genres/films/list')
            ->json();

        $genresNav = $genres;

        $viewModel = new TvViewModel(
            $popularTv,
            $topRatedTv,
            $genres,
        );

        return view('tv.index', $viewModel,compact('genresNav'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function show(int $id) : View
    {
        $serie = Http::get('http://127.0.0.1:8001/api/1/series/'.$id.'')
            ->json();

        $genres = Http::get('http://127.0.0.1:8001/api/1/genres/films/list')
            ->json();

        $genresNav = $genres;
        $viewModel = new TvShowViewModel($serie);

        return view('tv.show', $viewModel,compact('genresNav'));
    }
}
