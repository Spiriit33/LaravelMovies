<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    /** @var array  */
    private array $popularTv;
    /** @var array  */
    private array $topRatedTv;
    /** @var array  */
    private array $genres;

    /**
     * TvViewModel constructor.
     * @param $popularTv
     * @param $topRatedTv
     * @param $genres
     */
    public function __construct($popularTv, $topRatedTv, $genres)
    {
        $this->popularTv = $popularTv;
        $this->topRatedTv = $topRatedTv;
        $this->genres = $genres;
    }

    /**
     * @return Collection
     */
    public function popularTv() : Collection
    {
        return $this->formatTv($this->popularTv);
    }

    /**
     * @return Collection
     */
    public function topRatedTv() : Collection
    {
        return $this->formatTv($this->topRatedTv);
    }

    public function genres() : Collection
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    /**
     * @param $tv
     * @return Collection
     */
    private function formatTv($tv) : Collection
    {
        return collect($tv)->map(function($tvshow) {
            $genresFormatted = collect($tvshow['genre_ids'])->mapWithKeys(function($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($tvshow)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$tvshow['poster_path'],
                'vote_average' => $tvshow['vote_average'] * 10 .'%',
                'first_air_date' => Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres',
            ]);
        });
    }
}
