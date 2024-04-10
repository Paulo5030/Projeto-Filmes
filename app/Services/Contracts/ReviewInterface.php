<?php

namespace App\Services\Contracts;

interface ReviewInterface
{
    public function createReview(array $data, $id);
    public function getReviews($id);
    public function averageRating($id);
}