<?php

namespace App\Http\Controllers;

use App\Models\UserStatistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserStatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $stats = UserStatistic::where('user_id', $userId)->first();

        return response()->json($stats);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserStatistic $userStatistic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserStatistic $userStatistic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserStatistic $userStatistic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserStatistic $userStatistic)
    {
        //
    }
}
