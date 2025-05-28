<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    // Read all genre
    public function index()
    {
        $genres = Genre::all();

        if ($genres->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "No genre data found!"
            ], 200);
        }

        return response()->json([
            "success" => true,
            "message" => "Get all genres",
            "data" => $genres
        ], 200);
    }

    // Create genre
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }
        $genre = Genre::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Genre created successfully!',
            'data' => $genre
        ], 201);
    }
      public function show(string $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Get detail resource',
            'data' => $genre
        ], 200);
    }


    public function destroy(string $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found'
            ], 404);
        }
        $genre->delete();

        return response()->json([
            'success' => true,
            'message' => 'Delete resource successfully'
        ]);
    }

     public function update(string $id, Request $request)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found'
            ], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }
        $data = [
            'name' => $request->name,
        
        ];
        $genre->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Resource Updated Sussesfully',
            'data' => $genre
        ], 200);
    }
}
