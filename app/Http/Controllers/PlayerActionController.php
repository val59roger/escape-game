<?php

namespace App\Http\Controllers;

use App\Models\PlayerAction;
use Illuminate\Http\Request;

class PlayerActionController extends Controller
{
    public function index()
    {
        return PlayerAction::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'enigma_id' => 'nullable|exists:enigmas,id',
            'item_id' => 'nullable|exists:items,id',
            'action' => 'required|string',
        ]);

        return PlayerAction::create($request->all());
    }

    public function show(PlayerAction $playerAction)
    {
        return $playerAction;
    }

    public function destroy(PlayerAction $playerAction)
    {
        $playerAction->delete();
        return response()->json(['message' => 'Player action deleted successfully']);
    }
}
