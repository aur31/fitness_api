<?php

namespace App\Http\Controllers;

use App\Models\MarketPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MarketPlaceController extends Controller
{
    public function index()
    {
        $marketPlaces = MarketPlace::all();
        return response()->json($marketPlaces);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url',
            'status' => 'boolean',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $marketPlace = MarketPlace::create([
            'market_id' => Str::uuid()->toString(),
            'name' => $validatedData['name'],
            'url' => $validatedData['url'],
            'status' => $validatedData['status'] ?? true,
            'user_id' => $validatedData['user_id'],
        ]);

        return response()->json($marketPlace, 201);
    }

    public function show(MarketPlace $marketPlace)
    {
        return response()->json($marketPlace);
    }

    public function update(Request $request, MarketPlace $marketPlace)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'url' => 'nullable|url',
            'status' => 'sometimes|boolean',
            'user_id' => 'sometimes|nullable|exists:users,id',
        ]);

        $marketPlace->update($validatedData);

        return response()->json($marketPlace);
    }

    public function destroy(MarketPlace $marketPlace)
    {
        $marketPlace->delete();
        return response()->json(null, 204);
    }
}
