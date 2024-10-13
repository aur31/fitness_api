<?php

namespace App\Http\Controllers;

use App\Models\Vital;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VitalController extends Controller
{
    public function index()
    {
        $vitals = Vital::with('user')->get();
        return response()->json($vitals);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'bmi' => 'nullable|numeric',
            'blood_pressure' => 'nullable|string',
            'blood_sugar' => 'nullable|numeric',
            'heart_rate' => 'nullable|integer',
            'temperature' => 'nullable|numeric',
            'oxygen_saturation' => 'nullable|numeric',
        ]);

        $vital = Vital::create([
            'vital_id' => Str::uuid()->toString(),
            'user_id' => $validatedData['user_id'],
            'weight' => $validatedData['weight'],
            'height' => $validatedData['height'],
            'bmi' => $validatedData['bmi'],
            'blood_pressure' => $validatedData['blood_pressure'],
            'blood_sugar' => $validatedData['blood_sugar'],
            'heart_rate' => $validatedData['heart_rate'],
            'temperature' => $validatedData['temperature'],
            'oxygen_saturation' => $validatedData['oxygen_saturation'],
        ]);

        return response()->json($vital, 201);
    }

    public function show(Vital $vital)
    {
        return response()->json($vital->load('user'));
    }

    public function update(Request $request, Vital $vital)
    {
        $validatedData = $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'bmi' => 'nullable|numeric',
            'blood_pressure' => 'nullable|string',
            'blood_sugar' => 'nullable|numeric',
            'heart_rate' => 'nullable|integer',
            'temperature' => 'nullable|numeric',
            'oxygen_saturation' => 'nullable|numeric',
        ]);

        $vital->update($validatedData);

        return response()->json($vital);
    }

    public function destroy(Vital $vital)
    {
        $vital->delete();
        return response()->json(null, 204);
    }
}
