<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.main', function($view) {
            $genres = Http::get('http://127.0.0.1:8001/api/1/genres/films/list')
                ->object();
            $genres = $this->genres($genres);
            $view->with(array('genresHead' => $genres));
        });
    }

    private function genres($genres)
    {
        return collect($genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }
}
