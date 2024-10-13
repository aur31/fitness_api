<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:user,email',
            'name' => 'nullable|string',
            'sex' => 'nullable|string',
            'password' => 'required|string',
            'role' => 'nullable|integer',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        return response()->json($user, 200);
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'email' => 'sometimes|required|email|unique:users,email,' . $user->userId . ',userId',
            'name' => 'nullable|string',
            'sex' => 'nullable|string',
            'status' => 'nullable|boolean',
            'role' => 'nullable|integer',
        ]);

        $user->update($validatedData);

        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
