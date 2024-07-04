<?php

namespace App\Http\Controllers;

use App\Http\Resources\MenuResource;
use App\Models\menu;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
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
            'recipe' => 'required|string|max:1000',
            'meal' => 'required|string|max:200',
        ]);

        if(!$request->hasFile('image')){
            $response = [
                'success' => false,
                'message' => "Erreur d'ajout du menu, Pas d'image",
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

                $men = new menu();
                $men->fill($validator);
                //return ;
                
                //$grille->promotion = $grille->promotion == 0 ? '0' : '1'; 
                //return $grille->promotion;
                $men->image = $imageUrl;

                $men->save();

                $response = [
                    'success' => true,
                    'message' => "Produit enregistrer",
                    'grille' => new MenuResource($men),
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
