<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::all();
        return response()->json($ingredients);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'meal_id' => 'required|exists:meals,meal_id',
            'ingredient' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $ingredient = Ingredient::create([
            'ingredient_id' => Str::uuid()->toString(),
            'meal_id' => $validatedData['meal_id'],
            'ingredient' => $validatedData['ingredient'],
            'description' => $validatedData['description'],
        ]);

        return response()->json($ingredient, 201);
    }

    public function show(Ingredient $ingredient)
    {
        return response()->json($ingredient);
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $validatedData = $request->validate([
            'meal_id' => 'sometimes|required|exists:meals,meal_id',
            'ingredient' => 'sometimes|required|string',
            'description' => 'nullable|string',
        ]);

        $ingredient->update($validatedData);

        return response()->json($ingredient);
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return response()->json(null, 204);
    }
}
