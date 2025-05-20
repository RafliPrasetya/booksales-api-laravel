<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    // Read all authors
    public function index()
    {
        $authors = Author::all();

        if ($authors->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "No author data found!"
            ], 200);
        }

        return response()->json([
            "success" => true,
            "message" => "Get all authors",
            "data" => $authors
        ], 200);
    }

    // Create author
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',  // validasi email dan nullable
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $author = Author::create([
            'name' => $request->name,
            'email' => $request->email,  // sesuaikan dengan field di seeder dan db
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Author created successfully!',
            'data' => $author
        ], 201);
    }
}
