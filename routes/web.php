<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieStarController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/index', [MovieStarController::class, 'index'])->name('index');
Route::get('/listMovies', [MovieStarController::class, 'listMovies'])->name('listMovies');

Route::get('/auth', [AuthController::class, 'getAuth'])->name('getAuth');
Route::post('/auth', [AuthController::class, 'authcreate'])->name('authcreate');
Route::get('/user/profile', [AuthController::class, 'profile'])->name('profile');
Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::match(['get', 'post'],'/userProfile', [AuthController::class, 'userProfile'])->name('userProfile');
Route::match(['get', 'post'], '/user/update', [AuthController::class, 'updateUser'])->name('updateUser');
Route::match(['get', 'post'], '/updatePassword', [AuthController::class, 'updatePassword'])->name('updatePassword');

Route::match(['get', 'post'], '/getMovie/{id}', [MovieStarController::class, 'getMovie'])->name('getMovie');
Route::get( '/meetMovie/{id}', [MovieStarController::class, 'meetMovie'])->name('meetMovie');
Route::match( ['get', 'post'],'/review/{id}', [ReviewController::class, 'review'])->name('review');
Route::get( '/search', [MovieStarController::class, 'search'])->name('search');

Route::middleware('auth')->group(function () {
    Route::match(['get', 'post'],'/newMovie', [MovieStarController::class, 'newMovie'])->name('newMovie');
    Route::match(['get', 'post'],'/addMovie', [MovieStarController::class, 'addMovie'])->name('addMovie');
    Route::get('/dashboardMovie', [MovieStarController::class, 'dashboardMovie'])->name('dashboardMovie');
    Route::delete('/deleteMovie/{id}', [MovieStarController::class, 'deleteMovie'])->name('deleteMovie');
    Route::get( '/viewPageEditiMovie/{id}', [MovieStarController::class, 'viewPageEditiMovie'])->name('viewPageEditiMovie');
    Route::match( ['get', 'post'],'/editMovie/{id}', [MovieStarController::class, 'editMovie'])->name('editMovie');
});