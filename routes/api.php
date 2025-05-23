<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::delete('/books/{id}', [BookController::class, 'destroy']);
Route::post('/books', [BookController::class, 'store']);

Route::get('/genres', [GenreController::class, 'index']);
Route::get('/genres/{id}', [GenreController::class, 'show']);
Route::delete('/genres/{id}', [GenreController::class, 'destroy']);
Route::post('/genres/{id}', [GenreController::class, 'update']);
Route::post('/genres', [GenreController::class, 'store']);

Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/authors/{id}', [AuthorController::class, 'show']);
Route::delete('/authors/{id}', [AuthorController::class, 'destroy']);
Route::post('/authors/{id}', [AuthorController::class, 'update']);
Route::post('/authors', [AuthorController::class, 'store']);
