<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


Route::get('/', [FilmController::class, 'movieHome'])->name('home');


Route::get('/movies', [FilmController::class, 'movies'])->name('movies');
Route::get('/movies/{film}', [FilmController::class, 'show'])->name('movies.show');
Route::get('/movies/genre/{genre}', [FilmController::class, 'moviesByGenre'])->name('genre');

Route::get('/dashboard/user', [DashboardController::class, 'user'])
    ->middleware(['auth', 'can:user'])
    ->name('dashboard.user');

Route::get('/dashboard/admin', [DashboardController::class, 'admin'])
    ->middleware(['auth', 'can:admin'])
    ->name('dashboard.admin');

Route::middleware(['auth', 'can:user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
});

Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'admin'])
        ->name('admin.dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => redirect()->route('home')->with('auth_modal', 'login'))
        ->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

    Route::get('/register', fn () => redirect()->route('home')->with('auth_modal', 'register'))
        ->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
});


Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
