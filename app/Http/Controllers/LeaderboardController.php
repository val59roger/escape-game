<?php

namespace App\Http\Controllers;

use App\Models\Leaderboard;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index()
    {
        return Leaderboard::orderBy('score', 'desc')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'scenario_id' => 'required|exists:scenarios,id',
            'score' => 'required|integer',
        ]);

        return Leaderboard::create($request->all());
    }

    public function show(Leaderboard $leaderboard)
    {
        return $leaderboard;
    }

    public function destroy(Leaderboard $leaderboard)
    {
        $leaderboard->delete();
        return response()->json(['message' => 'Leaderboard entry deleted successfully']);
    }
}
