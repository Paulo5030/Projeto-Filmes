<?php

namespace App\Repositories;

use App\Models\Movie;

class MovieRepository
{
    public function __construct(Movie $movie)
    {
    }

    public function buildMovie ($data) {
        $movie = new Movie();
        $movie->id = $data['id'];
        $movie->title = $data['title'];
        $movie->description = $data['description'];
        $movie->image = $data['image'];
        $movie->trailer = $data['trailer'];
        $movie->category = $data['category'];
        $movie->length = $data['length'];
        $movie->users_id = $data['users_id'];

        return $movie;
    }
}