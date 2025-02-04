<?php

namespace App\Http\Controllers;

use App\Models\Enigma;
use Illuminate\Http\Request;

class EnigmaController extends Controller
{
    public function index()
    {
        return Enigma::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'scenario_id' => 'required|exists:scenarios,id',
            'question' => 'required|string',
            'answer' => 'required|string',
            'hints' => 'nullable|array',
            'order' => 'required|integer',
        ]);

        return Enigma::create($request->all());
    }

    public function show(Enigma $enigma)
    {
        return $enigma;
    }

    public function update(Request $request, Enigma $enigma)
    {
        $request->validate([
            'question' => 'string',
            'answer' => 'string',
            'hints' => 'array',
            'order' => 'integer',
        ]);

        $enigma->update($request->all());

        return $enigma;
    }

    public function destroy(Enigma $enigma)
    {
        $enigma->delete();
        return response()->json(['message' => 'Enigma deleted successfully']);
    }
}
