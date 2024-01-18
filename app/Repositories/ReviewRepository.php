<?php

namespace App\Repositories;

use App\Models\Review;

class ReviewRepository
{
    public function __construct(Review $review)
    {
    }
    public function builReview ($data) {
        $review = new Review();
        $review->id = $data['id'];
        $review->rating = $data['rating'];
        $review->review = $data['review'];
        $review->users_id = $data['users_id'];
        $review->movies_id = $data['movies_id'];

        return $review;
    }
}