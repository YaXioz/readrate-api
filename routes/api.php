<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RatingController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);

Route::post('/ratings', [RatingController::class, 'store'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->post('/ratings', [RatingController::class, 'store']);
