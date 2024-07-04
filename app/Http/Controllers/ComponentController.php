<?php

namespace App\Http\Controllers;

use App\Http\Resources\ComponentResource;
use App\Models\Components;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComponentController extends Controller
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
            //'id_utilisateur' => 'required|string|max:60',
            'name' => 'required|string|max:60',
        ]);

        if(!$request->hasFile('image')){
            $response = [
                'success' => false,
                'message' => "Erreur Component, Pas d'image",
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

                $comp = new Components();
                $comp->fill($validator);
                //return ;
                
                //$grille->promotion = $grille->promotion == 0 ? '0' : '1'; 
                //return $grille->promotion;
                $comp->image = $imageUrl;

                $comp->save();

                $response = [
                    'success' => true,
                    'message' => "Component enregistrer",
                    'component' => new ComponentResource($comp),
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
