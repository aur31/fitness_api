<?php

namespace App\Http\Controllers;

use App\Models\SportExercise;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SportExerciseController extends Controller
{
    public function index()
    {
        $sportExercises = SportExercise::with('sportCategory')->get();
        return response()->json($sportExercises);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sport_cat_id' => 'required|exists:sport_categories,sport_cat_id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'boolean',
            'image' => 'nullable|string',
        ]);

        $sportExercise = SportExercise::create([
            'sport_exercise_id' => Str::uuid()->toString(),
            'sport_cat_id' => $validatedData['sport_cat_id'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'status' => $validatedData['status'] ?? true,
            'image' => $validatedData['image'],
        ]);

        return response()->json($sportExercise, 201);
    }

    public function show(SportExercise $sportExercise)
    {
        return response()->json($sportExercise->load('sportCategory'));
    }

    public function update(Request $request, SportExercise $sportExercise)
    {
        $validatedData = $request->validate([
            'sport_cat_id' => 'sometimes|required|exists:sport_categories,sport_cat_id',
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|boolean',
            'image' => 'nullable|string',
        ]);

        $sportExercise->update($validatedData);

        return response()->json($sportExercise);
    }

    public function destroy(SportExercise $sportExercise)
    {
        $sportExercise->delete();
        return response()->json(null, 204);
    }
}
