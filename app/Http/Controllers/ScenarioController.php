<?php

namespace App\Http\Controllers;

use App\Models\Scenario;
use Illuminate\Http\Request;

class ScenarioController extends Controller
{
    public function index()
    {
        return Scenario::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'difficulty' => 'required|in:easy,medium,hard',
        ]);

        return Scenario::create($request->all());
    }

    public function show(Scenario $scenario)
    {
        return $scenario;
    }

    public function update(Request $request, Scenario $scenario)
    {
        $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'difficulty' => 'in:easy,medium,hard',
        ]);

        $scenario->update($request->all());

        return $scenario;
    }

    public function destroy(Scenario $scenario)
    {
        $scenario->delete();
        return response()->json(['message' => 'Scenario deleted successfully']);
    }
}
