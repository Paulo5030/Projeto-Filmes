<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Services\MessageService;
use App\Services\MovieStarService;
use App\Services\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieStarController extends Controller
{
    public function __construct(protected MovieStarService $movieStarService,
                                 protected MessageService $messageService,
                                 protected ReviewService $reviewService
    )
    {
    }
    public function index () {
        $user = Auth::user();
        $name = $user->name;
        $movieNovos = Movie::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $movieAcao = Movie::where('user_id', $user->id)->get()
        ->where('category', 'Ação');
        $movieComedia = Movie::where('user_id', $user->id)->get()
        ->where('category', 'Comédia');
        return view('app.index', compact('name', 'movieNovos', 'movieAcao', 'movieComedia'));
    }

    public function listMovies () {
        $movies = Movie::all();
        foreach ($movies as $movie) {
            $movie->averageRating = $this->reviewService->averageRating($movie->id);
        }
        return view('app.listMovies', compact('movies'));
    }
    public function newMovie () {
        $user = Auth::user();
        $name = $user->name;
        return view('app.newmovie', compact('name'));
    }
    public function addMovie (Request $request)
    {
        $result = $this->movieStarService->addMovie($request->all());
        if ($result) {
            return redirect()->route('index');
        }
        return redirect()->route('newMovie');
    }
    public function dashboardMovie()
    {
        $user = Auth::user();
        $name = $user->name;
        $movies = Movie::where('user_id', $user->id)->get();
        foreach ($movies as $movie) {
            $movie->averageRating = $this->reviewService->averageRating($movie->id);
        }
        return view('app.dashboard', compact('name', 'movies'));
    }
    public function getMovie ($id) {
        $user = Auth::user();
        $name = $user?->name;
        $movie = Movie::where('user_id', $user->id)->find($id);

        if (!$movie) {
            $this->messageService->messageMovieNotFound();
            return redirect()->route('dashboardMovie');
        }
        $image = $movie->image;

        if ($movie->user->id !== $user->id) {
            $this->messageService->messageMovieNotFound();
            return redirect()->route('dashboardMovie');
        }

            $movie->averageRating = $this->reviewService->averageRating($movie->id);

        return view('app.movie', compact('movie', 'name', 'image'));
    }
    public function viewPageEditiMovie ($id) {
        $user = Auth::user();
        $name = $user->name;
        $movie = Movie::where('user_id', $user->id)->find($id);
        return view('app.editMovie', compact('movie', 'name'));
    }
    public function editMovie (Request $request, $id) {
        $user = Auth::user();
        $name = $user->name;
        $movie = Movie::where('user_id', $user->id)->find($id);
        if ($request->isMethod('post')) {
            $this->movieStarService->editMovie($request->all());
            $movie = Movie::where('user_id', $user->id)->find($id);
        }
        return view('app.editMovie', compact('movie', 'name'));
    }
    public function deleteMovie ($id) {
        $this->movieStarService->deleteMovie($id);
        return redirect()->route('dashboardMovie');
    }
    public function meetMovie ($id) {
        $user = Auth::user();
        $movie = Movie::find($id);

        if (!$movie) {
            return redirect()->route('listMovies');
        }

        $hasReviewd = $user && $movie->review->contains('users_id', $user->id);

        $show = $this->reviewService->getReviews($id);

        $ratingReview = $this->reviewService->averageRating($id);

        $isMovieOwner = $user && $movie && $movie->user_id === $user->id;
        return view('app.meetmovie', compact('movie', 'isMovieOwner', 'show', 'hasReviewd', 'ratingReview'));
    }
    public function search(Request $request)
    {

        $q = $request->input('q');

        if (!empty($q)) {
            $movieNovos = Movie::where('title', 'like', '%' . $q . '%')
                ->orWhere('description', 'like', '%' . $q . '%')
                ->latest()
                ->get();
            foreach ($movieNovos as $movie) {
                $movie->averageRating = $this->reviewService->averageRating($movie->id);
            }
        } else {
            $movieNovos = collect();
        }

        return view('app.search', compact('movieNovos', 'q'));
    }
}
