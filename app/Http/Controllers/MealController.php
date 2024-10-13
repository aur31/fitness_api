<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MealController extends Controller
{
    public function index()
    {
        $meals = Meal::with('ingredients')->get();
        return response()->json($meals);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'meal_name' => 'required|string|max:255',
            'recipes' => 'nullable|string',
            'status' => 'boolean',
            'user_id' => 'required|exists:users,id',
        ]);

        $meal = Meal::create([
            'meal_id' => Str::uuid()->toString(),
            'meal_name' => $validatedData['meal_name'],
            'recipes' => $validatedData['recipes'],
            'status' => $validatedData['status'] ?? true,
            'user_id' => $validatedData['user_id'],
        ]);

        return response()->json($meal, 201);
    }

    public function show(Meal $meal)
    {
        return response()->json($meal->load('ingredients'));
    }

    public function update(Request $request, Meal $meal)
    {
        $validatedData = $request->validate([
            'meal_name' => 'sometimes|required|string|max:255',
            'recipes' => 'nullable|string',
            'status' => 'sometimes|boolean',
            'user_id' => 'sometimes|required|exists:users,id',
        ]);

        $meal->update($validatedData);

        return response()->json($meal);
    }

    public function destroy(Meal $meal)
    {
        $meal->delete();
        return response()->json(null, 204);
    }
}
