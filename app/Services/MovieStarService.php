<?php

namespace App\Services;

use App\Models\Movie;
use App\Repositories\MovieRepository;
use Illuminate\Support\Facades\Auth;

class MovieStarService
{
    public function __construct(protected MovieRepository $movieRepository,
                                protected MessageService $messageService,
    )
    {
    }
    public function addMovie (array $data) {
        $type = $data['type'] ?? null;

        if ($type === 'create') {
            $title = $data['title'] ?? null;
            $description = $data['description'] ?? null;
            $trailer = $data['trailer'] ?? null;
            $category = $data['category'] ?? null;
            $length = $data['length'] ?? null;

            if (!$title || !$description || !$category) {
                $this->messageService->messageErrorAddMovie();
                return false;
            }

            $userId = Auth::id();

            $movie = new Movie();
            $movie->title = $title;
            $movie->description = $description;
            $movie->trailer = $trailer;
            $movie->category = $category;
            $movie->length = $length;
            $movie->user_id = $userId;

            $image = $data['image'] ?? null;
            if ($image && $image->isValid()) {
                $path = $image->store('public/img/movie');
                $movie->image = str_replace('public/', 'storage/', $path);
            }
            $movie->save();
            $this->messageService->messageAddMovie();
            return true;
        }
        return false;
    }
    public function editMovie (array $data) {
        $type = $data['type'] ?? null;

        if ($type === 'update') {

            $user = Auth::user();

            if (!$user) {
                return redirect()->route('login');
            }

            $id = request('id');
            $movie = Movie::find($id);

            if (!$movie) {
                $this->messageService->messageMovieNotFound();
                return redirect()->route('dashboardMovie');
            }

            if ($movie->user_id !== $user->id) {
                return redirect()->route('dashboardMovie')->with('error', 'Você não tem permissão para editar este filme.');
            }


            $movie->title = $data['title'] ?? null;
            $movie->description = $data['description'] ?? null;
            $movie->trailer = $data['trailer'] ?? null;
            $movie->category = $data['category'] ?? null;
            $movie->length = $data['length'] ?? null;
            $movie->id = $data['id'] ?? null;

            if (empty($data['title']) || empty($data['description']) || empty($data['category'])) {
                $this->messageService->messageErrorAddMovie();
                return false;
            }

            $image = $data['image'] ?? null;
            if ($image && $image->isValid()) {
                $path = $image->store('public/img/movie');
                $movie->image = str_replace('public/', 'storage/', $path);
            }
            $movie->save();
            $this->messageService->messageUpdateMovie();
            return true;
        }
        return false;
    }
    public function deleteMovie ($id) {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $movie = Movie::find($id);

        if (!$movie) {
            $this->messageService->messageMovieNotFound();
            return redirect()->route('dashboardMovie');
        }

        if ($movie->user_id !== $user->id) {
            return redirect()->route('getMovie', ['id' => $id])->with('error', 'Você não tem permissão para excluir este filme.');

        }
        $movie->delete();
        $this->messageService->messageExcludeMovie();
        return true;
    }
 }