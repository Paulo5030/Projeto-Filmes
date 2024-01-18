<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use App\Services\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct(protected ReviewService $reviewService)
    {
    }
    public function review (Request $request, $id)
    {
        $user = Auth::user();
        $result = $this->reviewService->createReview($request->all(), $id);
        $movie = Movie::find($id);
        $reviews = Review::all();


        if ($result) {
            return redirect()->route('listMovies', compact('user', 'movie', 'reviews'));
        }
        $isMovieOwner = $user && $movie && $movie->user_id === $user->id;
        return view('app.meetmovie', compact('movie',  'isMovieOwner'));
    }
}