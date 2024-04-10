<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use App\Services\Contracts\AuthInterface;
use App\Services\Contracts\ReviewInterface;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(protected AuthInterface $authService,
                                protected MessageService $messageService,
                                protected ReviewInterface $reviewService
    ) {
    }

    public function getAuth()
    {
        return view('app.authUser');
    }

    public function authcreate(Request $request)
    {
        $result = $this->authService->create($request->all());
        if ($result) {
            $user = User::create($request->all());
            Auth::login($user);
            return redirect()->route('userProfile', ['name' => $user->name]);
        }
        return view('app.authUser');
    }
    public function updateUser(Request $request)
    {
        $result = $this->authService->updateUser($request->all());
         if ($result) {
             return redirect()->route('userProfile');
         }
        return redirect()->route('login');
    }
    public function updatePassword(Request $request)
    {
        $result = $this->authService->updatePassword($request->all());
        if ($result) {
              return redirect()->route('userProfile');
            }
        return redirect()->route('login');
    }
    public function login(Request $request)
    {
        $credentials = $request->all('email', 'password');

        if (Auth::attempt($credentials)) {
                $user = Auth::user()->only(['name', 'lastname']);
                $this->messageService->setWelcomeMessage($user['name']);
                return redirect()->route('userProfile', compact('user'));
        }
        $this->messageService->messageLogininvalidUser();
        return view('app.authUser');
    }
    public function logout ()
    {
        Auth::logout();
        $this->messageService->messageLogoutdUser();
        return redirect()->route('getAuth');
    }

    public function userProfile()
    {
        $user = Auth::user()->only(['name', 'lastname', 'email', 'image', 'bio']);
        return view('app.login', compact('user'));
    }

    public function profile($id = null)
    {
        if ($id !== null) {
            $user = Auth::user()->only((['name', 'lastname', 'email', 'image', 'bio']));
            $movies = Movie::where('user_id', $id)->get();

            foreach ($movies as $movie) {
                $movie->averageRating = $this->reviewService->averageRating($movie->id);
            }

            $hasReviewed = false;

            return view('app.profile', compact('user', 'hasReviewed'));
        }
            $user = Auth::user()->only(['name', 'lastname', 'email', 'image', 'bio', 'id']);
            $movies = Movie::where('user_id', $user['id'])->get();

            $hasReviewed = $user && Review::whereIn('movies_id', $movies->pluck('id'))->where('users_id', $user['id'])->exists();

            return view('app.profile', compact('movies', 'user', 'hasReviewed'));
        }

}
