<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use App\Services\AuthService;
use App\Services\MessageService;
use App\Services\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService,
                                protected MessageService $messageService,
                                protected ReviewService $reviewService
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
            $name = $user->name;
            return redirect()->route('userProfile', ['name' => $name]);
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
            $user = User::find(auth()->id());
            if ($user) {
                $user->update($request->all());
                return redirect()->route('userProfile');
            }
        }
        return redirect()->route('login');
    }
    public function login(Request $request)
    {
        $credentials = $request->all('email', 'password');

        if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $name = $user->name;
                $lastname = $user->lastname;
                $this->messageService->setWelcomeMessage($name);
                return redirect()->route('userProfile', ['name' => $name, 'lastname' => $lastname]);
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
        $user = Auth::user();
        $name = $user->name;
        $lastname = $user->lastname;
        $email = $user->email;
        $image = $user->image;
        $bio = $user->bio;
        return view('app.login', compact('name', 'lastname', 'email', 'image', 'bio', 'user'));
    }

    public function profile($id = null)
    {
        if ($id !== null) {
            $user = User::findOrFail($id);
            $name = $user->name;
            $lastname = $user->lastname;
            $email = $user->email;
            $image = $user->image;
            $bio = $user->bio;
            $movies = Movie::where('user_id', $id)->get();

            foreach ($movies as $movie) {
                $movie->averageRating = $this->reviewService->averageRating($movie->id);
            }

            $hasReviewed = false;

            return view('app.profile', compact('name', 'lastname', 'email', 'image', 'bio', 'movies', 'user', 'hasReviewed'));
        }
            $user = Auth::user();
            $movies = Movie::where('user_id', $user->id)->get();
            $name = $user->name;
            $lastname = $user->lastname;
            $email = $user->email;
            $image = $user->image;
            $bio = $user->bio;

            $hasReviewed = $user && Review::whereIn('movies_id', $movies->pluck('id'))->where('users_id', $user->id)->exists();

            return view('app.profile', compact('name', 'lastname', 'email', 'image', 'bio', 'movies', 'user', 'hasReviewed'));
        }

}
