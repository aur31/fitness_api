<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Exception;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request;
        $validator = $request->validate([
            'user_id' => 'required|string|max:32',
            'comment' => 'required|string|max:250',
        ]);


            try{
                
                

                $comm = new Comment();
                $comm->fill($validator);
                

                $comm->save();

                $response = [
                    'success' => true,
                    'message' => "Comment enregistrer",
                    'comment' => new CommentResource($comm),
                ];
                return response($response, 200);
            }catch(Exception $e){
                $response = [
                    'success' => false,
                    'message' => $e,
                ];
                return response($response, 404);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
