<?php

namespace App\Repositories;

use App\Models\Review;

class ReviewRepository
{
    private $review;
    public function __construct(Review $review)
    {
        $this->review = $review;
    }
    public function builReview ($data) {
        $this->review->id = $data['id'];
        $this->review->rating = $data['rating'];
        $this->review->review = $data['review'];
        $this->review->users_id = $data['users_id'];
        $this->review->movies_id = $data['movies_id'];

        return $this->review;
    }
}