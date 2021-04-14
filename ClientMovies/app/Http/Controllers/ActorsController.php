<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\ActorViewModel;
use App\ViewModels\ActorsViewModel;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $page
     * @return View
     */
    public function index($page = 1) : View
    {
        abort_if($page > 500, 204);

        $popularActors = Http::get('http://127.0.0.1:8001/api/1/acteurs/page/'.$page.'')
            ->json()['results'];

        $viewModel = new ActorsViewModel($popularActors, $page);

        return view('actors.index', $viewModel);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function show(int $id) : View
    {
        //Get actor details.
        $actor = Http::get('http://127.0.0.1:8001/api/1/acteurs/show/'.$id.'')
            ->json();

        //Get social media details.
        $social = Http::get('http://127.0.0.1:8001/api/1/acteurs/show/'.$id.'/external_ids')
            ->json();

        //Get credits.
        $credits = Http::get('http://127.0.0.1:8001/api/1/acteurs/show/'.$id.'/combined_credits')
            ->json();

        $viewModel = new ActorViewModel($actor, $social, $credits);

        return view('actors.show', $viewModel);
    }
}
