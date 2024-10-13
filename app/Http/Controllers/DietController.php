<?php

namespace App\Http\Controllers;

use App\Models\Diet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DietController extends Controller
{
    public function index()
    {
        $diets = Diet::all();
        return response()->json($diets);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'label' => 'required|string|max:255',
        ]);

        $diet = Diet::create([
            'diet_id' => Str::uuid()->toString(),
            'label' => $validatedData['label'],
        ]);

        return response()->json($diet, 201);
    }

    public function show(Diet $diet)
    {
        return response()->json($diet);
    }

    public function update(Request $request, Diet $diet)
    {
        $validatedData = $request->validate([
            'label' => 'required|string|max:255',
        ]);

        $diet->update($validatedData);

        return response()->json($diet);
    }

    public function destroy(Diet $diet)
    {
        $diet->delete();
        return response()->json(null, 204);
    }
}
