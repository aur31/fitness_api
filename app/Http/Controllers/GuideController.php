<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuideController extends Controller
{
    public function index()
    {
        $guides = Guide::all();
        return response()->json($guides);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'guide' => 'required|string',
            'status' => 'boolean',
            'user_id' => 'required|exists:users,id',
        ]);

        $guide = Guide::create([
            'guide_id' => Str::uuid()->toString(),
            'guide' => $validatedData['guide'],
            'status' => $validatedData['status'] ?? true,
            'user_id' => $validatedData['user_id'],
        ]);

        return response()->json($guide, 201);
    }

    public function show(Guide $guide)
    {
        return response()->json($guide);
    }

    public function update(Request $request, Guide $guide)
    {
        $validatedData = $request->validate([
            'guide' => 'sometimes|required|string',
            'status' => 'sometimes|boolean',
            'user_id' => 'sometimes|required|exists:users,id',
        ]);

        $guide->update($validatedData);

        return response()->json($guide);
    }

    public function destroy(Guide $guide)
    {
        $guide->delete();
        return response()->json(null, 204);
    }
}
