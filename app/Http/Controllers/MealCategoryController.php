<?php

namespace App\Http\Controllers;

use App\Models\MealCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MealCategoryController extends Controller
{
    public function index()
    {
        $mealCategories = MealCategory::all();
        return response()->json($mealCategories);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'boolean',
            'description' => 'nullable|string',
        ]);

        $mealCategory = MealCategory::create([
            'meal_cat_id' => Str::uuid()->toString(),
            'name' => $validatedData['name'],
            'status' => $validatedData['status'] ?? true,
            'description' => $validatedData['description'],
        ]);

        return response()->json($mealCategory, 201);
    }

    public function show(MealCategory $mealCategory)
    {
        return response()->json($mealCategory);
    }

    public function update(Request $request, MealCategory $mealCategory)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|boolean',
            'description' => 'nullable|string',
        ]);

        $mealCategory->update($validatedData);

        return response()->json($mealCategory);
    }

    public function destroy(MealCategory $mealCategory)
    {
        $mealCategory->delete();
        return response()->json(null, 204);
    }
}
