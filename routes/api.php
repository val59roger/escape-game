<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScenarioController;
use App\Http\Controllers\EnigmaController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayerActionController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\UserStatisticController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('scenarios', ScenarioController::class);
Route::apiResource('enigmas', EnigmaController::class);
Route::apiResource('items', ItemController::class);
Route::apiResource('games', GameController::class);
Route::apiResource('player-actions', PlayerActionController::class);
Route::apiResource('leaderboard', LeaderboardController::class);
Route::apiResource('saves', SaveController::class);
Route::middleware('auth:sanctum')->get('/user/statistics', [UserStatisticController::class, 'index']);
Route::middleware('auth:sanctum')->post('/save-score', [GameController::class, 'store']);
