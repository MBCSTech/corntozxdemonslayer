<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayerFormController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/intro', function(){
    return view('intro');
})->name('intro');

Route::get('/game', function(){
    return view('game');
})->name('game');

Route::get('/leaderboard', [GameController::class, 'index'])->name('leaderboard');

Route::post('/save-score', function (Request $request) {
    session(['last_game_score' => $request->score]);
    return response()->json(['success' => true]);
});

Route::get('/form-submission', [PlayerFormController::class, 'index'])->name('form-submission');
Route::post('/form-submission', [PlayerFormController::class, 'store'])->name('player.store');

Route::get('/confirm', function () {
    return view('confirmation');
})->name('game');

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
