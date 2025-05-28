<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route publik (tanpa autentikasi)
Route::apiResource('/books', BookController::class)->only(['index', 'show']);
Route::apiResource('/authors', AuthorController::class)->only(['index', 'show']);
Route::apiResource('/genres', GenreController::class)->only(['index', 'show']);

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

// Route yang memerlukan autentikasi
Route::middleware(['auth:api'])->group(function () {

    // Semua transaksi yang bisa diakses user terautentikasi
    Route::apiResource('/transactions', TransactionController::class)->only(['show', 'store', 'update']);

    // Route hanya untuk admin
    Route::middleware(['role:admin'])->group(function () {
        Route::apiResource('/genres', GenreController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('/authors', AuthorController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('/books', BookController::class)->only(['store', 'update', 'destroy']);

        // Transaksi Hanya admin 
        Route::apiResource('/transactions', TransactionController::class)->only(['destroy','index']);
    });
});
