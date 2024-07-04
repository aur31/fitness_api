<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExerciseResource;
use App\Models\Exercise;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExerciseController extends Controller
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
        
        if(!$request->hasFile('image')){
            $response = [
                'success' => false,
                'message' => "Erreur Exercise, Pas d'image",
            ];
            return response($response, 400);
        }



            try{

                $image = $request->file('image');

                // Generate a unique filename for the image
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                // Store the image in the public/images directory
                $imagePath = $image->storeAs('public/images', $imageName);

                // You can optionally save the image path to the database
                $imageUrl = Storage::url($imagePath);

                
                $exer = new Exercise();
                $exer->exercise_demo = $imageUrl;
                $exer->save();

                $response = [
                    'success' => true,
                    'message' => "Exercise enregistrer",
                    'sport' => new ExerciseResource($exer),
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
