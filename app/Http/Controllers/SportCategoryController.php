<?php

namespace App\Http\Controllers;

use App\Models\SportCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SportCategoryController extends Controller
{
    public function index()
    {
        $sportCategories = SportCategory::all();
        return response()->json($sportCategories);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $sportCategory = SportCategory::create([
            'name' => $validatedData['name'],
            'status' => $validatedData['status'] ?? 1,
            'description' => $validatedData['description'],
        ]);

        return response()->json($sportCategory, 200);
    }

    public function show(SportCategory $sportCategory)
    {
        return response()->json($sportCategory);
    }

    public function update(Request $request, SportCategory $sportCategory)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|boolean',
            'description' => 'nullable|string',
        ]);

        $sportCategory->update($validatedData);

        return response()->json($sportCategory);
    }

    public function destroy(SportCategory $sportCategory)
    {
        $sportCategory->delete();
        return response()->json(null, 204);
    }
}
