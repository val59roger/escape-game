<?php

namespace App\Http\Controllers;

use App\Models\Save;
use Illuminate\Http\Request;

class SaveController extends Controller
{
    public function index()
    {
        return Save::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'data' => 'required|json',
        ]);

        return Save::create($request->all());
    }

    public function show(Save $save)
    {
        return $save;
    }

    public function update(Request $request, Save $save)
    {
        $request->validate([
            'data' => 'required|json',
        ]);

        $save->update($request->all());

        return $save;
    }

    public function destroy(Save $save)
    {
        $save->delete();
        return response()->json(['message' => 'Save deleted successfully']);
    }
}
