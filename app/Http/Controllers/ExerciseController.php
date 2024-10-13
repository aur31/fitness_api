<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\SportExercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ExerciseController extends Controller
{
    public function index()
    {
        $exercises = Exercise::all();

        /*foreach ($exercises as $key => $value) {
            # code...
        }*/

        foreach ($exercises as $exercise) {
            # code...
            $exercise->url = url(Storage::url($exercise->url));
        }
        
        return response()->json($exercises);
    }

    public function store(Request $request)
    {

        $request->validate([
            'video' => 'required|file|max:100000', // Max 100MB
            'name' => 'required|string|max:255',
            'sport_cat_id' => 'required|string|max:255',
        ]);

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Store the file in the public disk under the 'videos' directory
            $path = $file->storeAs('videos', $fileName, 'public');

            $exercise = Exercise::create([
                'name' => $request->name,
                'url' => $path,
                'status' => $request->status ?? 1,
            ]);

            $sportExercise = SportExercise::create([
                'sport_cat_id' => $request->sport_cat_id,
                'exercise_id' => $exercise->exercise_id,
            ]);

            $exercise->url = url(Storage::url($exercise->url));
            return response()->json($exercise, 200);

            return response()->json([
                'message' => 'Video uploaded successfully',
                'path' => Storage::url($path), // Get the URL for the stored file
                "link" => url(Storage::url($exercise->url))
            ], 200);
        }

        return response()->json(['message' => 'No video file provided'], 400);
    }

    public function show(Exercise $exercise)
    {
        return response()->json($exercise);
    }

    public function update(Request $request, Exercise $exercise)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'url' => 'nullable|url',
            'status' => 'sometimes|boolean',
        ]);

        $exercise->update($validatedData);

        return response()->json($exercise);
    }

    public function destroy(Exercise $exercise)
    {
        $exercise->delete();
        return response()->json(null, 204);
    }

    //THIS IS USE TO PLAY ALL VIDEOS
    public function getVideoUrl($id)
    {
        $exercise = Exercise::findOrFail($id);
        $videoUrl = url(Storage::url($exercise->url));

        return response()->json([
            'video_url' => $videoUrl
        ]);
    }
}
