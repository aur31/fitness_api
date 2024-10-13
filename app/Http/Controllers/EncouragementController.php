<?php

namespace App\Http\Controllers;

use App\Models\Encouragement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EncouragementController extends Controller
{
    public function index()
    {
        $encouragements = Encouragement::all();
        return response()->json($encouragements);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'encouragement' => 'required|string',
            'user_id' => 'nullable|exists:user,user_id',
        ]);

        $encouragement = Encouragement::create([
            'encouragement' => $validatedData['encouragement'],
            'status' => $validatedData['status'] ?? 1,
            'user_id' => $validatedData['user_id'],
        ]);

        return response()->json($encouragement, 200);
    }

    public function show(Encouragement $encouragement)
    {
        return response()->json($encouragement);
    }

    public function update(Request $request, Encouragement $encouragement)
    {
        $validatedData = $request->validate([
            'encouragement' => 'sometimes|required|string',
            'status' => 'sometimes|boolean',
            'user_id' => 'sometimes|nullable|exists:users,id',
        ]);

        $encouragement->update($validatedData);

        return response()->json($encouragement);
    }

    public function destroy(Encouragement $encouragement)
    {
        $encouragement->delete();
        return response()->json(null, 204);
    }
}
