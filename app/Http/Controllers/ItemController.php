<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return Item::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'scenario_id' => 'required|exists:scenarios,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'is_usable' => 'boolean',
        ]);

        return Item::create($request->all());
    }

    public function show(Item $item)
    {
        return $item;
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'string',
            'description' => 'string',
            'is_usable' => 'boolean',
        ]);

        $item->update($request->all());

        return $item;
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return response()->json(['message' => 'Item deleted successfully']);
    }
}
