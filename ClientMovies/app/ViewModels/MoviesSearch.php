<?php


namespace App\ViewModels;


use Carbon\Carbon;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class MoviesSearch extends ViewModel
{
    /** @var array */
    private array $movies;
    /** @var array */
    private array $genres;

    public function __construct(array $movies, array $genres)
    {
        $this->movies = $movies;
        $this->genres = $genres;
    }

    /**
     * @return array
     */
    public function getGenres(): array
    {
        return $this->genres;
    }

    /**
     * @return array
     */
    public function getMovies(): array
    {
        return $this->movies;
    }

    /**
     * @return Collection
     */
    public function movies()
    {
        return $this->formatMovies($this->movies);
    }

    /**
     * @return Collection
     */
    public function genres() : Collection
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    /**
     * Format movies details.
     * @param $movies
     * @return Collection
     */
    private function formatMovies($movies): Collection
    {
        return collect($movies)->map(function ($movie) {
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'],
                'vote_average' => $movie['vote_average'] * 10 . '%',
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'title', 'vote_average', 'overview', 'release_date', 'genres',
            ]);
        });
    }
}
