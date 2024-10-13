<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return response()->json($menus);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'recipe' => 'required|string',
            'meal' => 'required|string',
            'image' => 'nullable|string',
        ]);

        $menu = Menu::create([
            'menu_id' => Str::uuid()->toString(),
            'recipe' => $validatedData['recipe'],
            'meal' => $validatedData['meal'],
            'image' => $validatedData['image'],
        ]);

        return response()->json($menu, 201);
    }

    public function show(Menu $menu)
    {
        return response()->json($menu);
    }

    public function update(Request $request, Menu $menu)
    {
        $validatedData = $request->validate([
            'recipe' => 'sometimes|required|string',
            'meal' => 'sometimes|required|string',
            'image' => 'nullable|string',
        ]);

        $menu->update($validatedData);

        return response()->json($menu);
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return response()->json(null, 204);
    }
}
