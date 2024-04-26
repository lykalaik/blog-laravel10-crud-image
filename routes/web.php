<?php


use App\Http\Controllers\PostController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home route
Route::get('/', function () {
    return view('dashboard');
})->name('home');

// Menut route
Route::get('/menu', [AboutController::class, 'index'])->name('menu');


// About route
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Reviews route
Route::get('/reviews', [ReviewsController::class, 'index'])->name('reviews');

// Dashboard route
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Posts resource routes
    Route::resource('posts', PostController::class);
});

require __DIR__.'/auth.php';
