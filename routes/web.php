<?php

use App\Http\Controllers\OptionController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Poll Routes
Route::get('/polls', [PollController::class, 'index'])->name('polls.index');
Route::post('/polls', [PollController::class, 'store'])->name('polls.store');
Route::get('/polls/{poll}', [PollController::class, 'show'])->name('polls.show');
Route::put('/polls/{poll}', [PollController::class, 'update'])->name('polls.update');
Route::delete('/polls/{poll}', [PollController::class, 'destroy'])->name('polls.destroy');
Route::get('/polls/{poll}/options', [PollController::class, 'options'])->name('polls.options');

//Options Routes
Route::post('/options', [OptionController::class, 'store'])->name('options.store');
Route::delete('/options/{option}', [OptionController::class, 'destroy'])->name('options.destroy');


require __DIR__.'/auth.php';
