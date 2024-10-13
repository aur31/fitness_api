<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return response()->json($comments);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|string|exists:users,id',
            'comment' => 'required|string',
            'status' => 'boolean',
        ]);

        $comment = Comment::create([
            'comment_id' => Str::uuid()->toString(),
            'user_id' => $validatedData['user_id'],
            'comment' => $validatedData['comment'],
            'status' => $validatedData['status'] ?? true,
        ]);

        return response()->json($comment, 201);
    }

    public function show(Comment $comment)
    {
        return response()->json($comment);
    }

    public function update(Request $request, Comment $comment)
    {
        $validatedData = $request->validate([
            'comment' => 'sometimes|required|string',
            'status' => 'sometimes|boolean',
        ]);

        $comment->update($validatedData);

        return response()->json($comment);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json(null, 204);
    }

}
