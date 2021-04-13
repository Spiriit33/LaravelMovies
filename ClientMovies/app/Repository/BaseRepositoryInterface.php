<?php


namespace App\Repository;


use Illuminate\Http\JsonResponse;

interface BaseRepositoryInterface
{
    public function getAll() : JsonResponse;
    public function find (int $id) : JsonResponse;
    public function getByGenres(array $genresIds) : JsonResponse;
}
