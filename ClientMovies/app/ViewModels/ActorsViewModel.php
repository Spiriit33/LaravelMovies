<?php

namespace App\ViewModels;

use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{
    /**
     * @var array
     */
    private array $popularActors;
    /**
     * @var int
     */
    private int $page;

    /**
     * ActorsViewModel constructor.
     * @param $popularActors
     * @param $page
     */
    public function __construct($popularActors, $page)
    {
        $this->popularActors = $popularActors;

        $this->page = $page;
    }

    /**
     * @return Collection
     */
    public function popularActors(): Collection
    {
        return collect($this->popularActors)->map(function($actor) {
            return collect($actor)->merge([
                'profile_path' => $actor['profile_path']
                    ? 'https://image.tmdb.org/t/p/w235_and_h235_face'.$actor['profile_path']
                    : 'https://ui-avatars.com/api/?size=235&name='.$actor['name'],
                'known_for' => collect($actor['known_for'])->where('media_type', 'movie')->pluck('title')->union(
                    collect($actor['known_for'])->where('media_type', 'tv')->pluck('name')
                )->implode(', '),
            ])->only([
                'name', 'id', 'profile_path', 'known_for',
            ]);
        });
    }

    /**
     * Previous pagination
     * @return int|null
     */
    public function previous(): ?int
    {
        return $this->page > 1 ? $this->page - 1 : null;
    }

    /**
     * Next pagination.
     * @return int|null
     */
    public function next(): ?int
    {
        return $this->page < 500 ? $this->page + 1 : null;
    }
}
