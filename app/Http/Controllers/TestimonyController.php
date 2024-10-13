<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestimonyController extends Controller
{
    public function index()
    {
        $testimonies = Testimony::with('user')->get();
        return response()->json($testimonies);
    }

    public function store(Request $request)
    {

        $testimony = Testimony::create([
            'testimony' => 'sometimes|required|string',
            'status' => 'sometimes|boolean',
            'user_id' => 'sometimes|required|exists:users,id',
            'user_id' => 'required',
        ]);

        return response()->json($testimony, 201);
    }

    public function show(Testimony $testimony)
    {
        return response()->json($testimony->load('user'));
    }

    public function update(Request $request, Testimony $testimony)
    {
        $validatedData = $request->validate([
            'testimony' => 'sometimes|required|string',
            'status' => 'sometimes|boolean',
            'user_id' => 'sometimes|required|exists:users,id',
        ]);

        $testimony->update($validatedData);

        return response()->json($testimony);
    }

    public function destroy(Testimony $testimony)
    {
        $testimony->delete();
        return response()->json(null, 204);
    }
}
