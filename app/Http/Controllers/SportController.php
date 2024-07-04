<?php

namespace App\Http\Controllers;

use App\Http\Resources\SportResource;
use App\Models\sport;
use Exception;
use Illuminate\Http\Request;

class SportController extends Controller
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
            'type' => 'required|string|max:60',
        ]);



            try{
                
                $spot = new sport();
                $spot->fill($validator);
                $spot->save();

                $response = [
                    'success' => true,
                    'message' => "Sport enregistrer",
                    'sport' => new SportResource($spot),
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
