<?php

namespace App\Services\Contracts;

interface MovieStarInterface
{
    public function addMovie(array $data);
    public function editMovie(array $data);
    public function deleteMovie($id);
}