<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->get();
         return response()->json([
            "success" => true,
            "message" => "Get all resources",
            "data" => $books
        ], 200);
        // return view('books.index', compact('books'));
    }
}
