<?php

namespace App\Http\Controllers;

use App\Http\Resources\GuideResource;
use App\Models\Guide;
use Exception;
use Illuminate\Http\Request;

class GuideController extends Controller
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
            'label' => 'required|string|max:32',
            'guide' => 'required|string|max:500',
            'diet_id' => 'required|string|max:36',
        ]);


            try{
                
                

                $guide = new Guide();
                $guide->fill($validator);
                

                $guide->save(); 

                $response = [
                    'success' => true,
                    'message' => "Guide enregistrer",
                    'guide' => new GuideResource($guide),
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
