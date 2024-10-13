<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ComponentController extends Controller
{
    public function index()
    {
        $components = Component::all();
        return response()->json($components);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|string',
            'name' => 'required|string',
        ]);

        $component = Component::create([
            'component_id' => Str::uuid()->toString(),
            'image' => $validatedData['image'],
            'name' => $validatedData['name'],
        ]);

        return response()->json($component, 201);
    }

    public function show(Component $component)
    {
        return response()->json($component);
    }

    public function update(Request $request, Component $component)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|string',
            'name' => 'sometimes|required|string',
        ]);

        $component->update($validatedData);

        return response()->json($component);
    }

    public function destroy(Component $component)
    {
        $component->delete();
        return response()->json(null, 204);
    }

}
