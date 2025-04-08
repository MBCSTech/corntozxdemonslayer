<?php

use App\Http\Controllers\Players;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PuzzleFormController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/game', function () {
    return view('game');
})->name('game');

Route::post('/save-score', function (Request $request) {
    session(['last_game_score' => $request->score]);
    return response()->json(['success' => true]);
});

Route::get('/form-submission', function () {
    $score = session('last_game_score', 0);
    return view('form-submission', ['score' => $score]);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PlayersController::class, 'show'])->name('dashboard');
    Route::get('/dashboard/{id}', [PlayersController::class, 'edit'])->name('player.edit');
    Route::patch('/dashboard/{id}', [PlayersController::class, 'update'])->name('player.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
