<?php

namespace App\Services;

use App\Models\Movie;
use App\Models\Review;
use App\Repositories\ReviewRepository;
use Illuminate\Support\Facades\Auth;

class ReviewService
{
    public function __construct(protected ReviewRepository $reviewRepository,
                                protected  MessageService $messageService)
    {
    }
    public function createReview (array $data, $id) {
        $type = $data['type'] ?? null;

        if ($type === 'create') {
            $rating = $data['rating'] ?? null;
            $userReview = $data['review'] ?? null;
            $moviesId = $data['movies_id'] ?? null;
        }

        $userId = Auth::id();

        $review = new Review();
        $review->rating = $rating;
        $review->review = $userReview;
        $review->movies_id = $moviesId;
        $review->users_id = $userId;

        $movie = Movie::find($id);

        if ($movie) {
            if (!$rating || !$userReview || !$moviesId) {
                $this->messageService->messageReviewError();
                return false;
            }
        }
        $review->save();
        $this->messageService->messageReview();
        return true;
    }
    public function getReviews ($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            $this->messageService->messageMovieNotFound();
        }

        return $movie->review;
    }
    public function averageRating ($id)
    {
        $averageRating = $this->getReviews($id)->avg('rating');
        return $averageRating;
    }
}