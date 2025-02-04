<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/game', fn() => Inertia::render('Game/Game'))->name('game');
    Route::get('/current-game', fn() => Inertia::render('Game/CurrentGame'))->name('current-game');
    Route::get('/game-archiver', fn() => Inertia::render('Game/GameArchiver'))->name('game-archiver');
    Route::get('/historique', fn() => Inertia::render('Game/Historique'))->name('historique');
});

require __DIR__.'/auth.php';
