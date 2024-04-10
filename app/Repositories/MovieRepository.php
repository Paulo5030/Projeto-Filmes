<?php

namespace App\Repositories;

use App\Models\Movie;

class MovieRepository
{
    private $movie;
    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    //Injetando no construtor a class pra ser utilizada quero dizer que MovieRepository depende da classe Movie para realizar suas operações, dessa forma passando a instancia real de Movie
    public function buildMovie ($data) {
        $this->movie->id = $data['id'];
        $this->movie->title = $data['title'];
        $this->movie->description = $data['description'];
        $this->movie->image = $data['image'];
        $this->movie->trailer = $data['trailer'];
        $this->movie->category = $data['category'];
        $this->movie->length = $data['length'];
        $this->movie->users_id = $data['users_id'];

        return $this->movie;
    }
    // por que é injetado no contrutor a class Movie e na funcao é feito o new
    // como utilizar bem o principio da abstracao e herança
    // criar os testes unitarios
}