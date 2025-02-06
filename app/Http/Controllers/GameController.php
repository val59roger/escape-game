<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Scenario;

class GameController extends Controller
{
    public function index()
    {
        return Game::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'scenario_id' => 'required|exists:scenarios,id',
            'score' => 'required|integer',
        ]);

        $game = Game::create([
            'user_id' => Auth::id(),
            'scenario_id' => $request->scenario_id,
            'status' => 'completed',
            'score' => $request->score,
            'start_time' => now(),
            'end_time' => now(),
        ]);

        return response()->json(['message' => 'Score sauvegardé !', 'game' => $game]);
    }

    public function show(Game $game)
    {
        return $game;
    }

    public function update(Request $request, Game $game)
    {
        $request->validate([
            'status' => 'in:in_progress,completed',
            'score' => 'integer',
        ]);

        $game->update($request->all());

        return $game;
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return response()->json(['message' => 'Game deleted successfully']);
    }

    public function getScenarioWithHints($scenarioId)
    {
        $scenario = Scenario::with('enigmas')->findOrFail($scenarioId);
        return response()->json($scenario);
    }

}
