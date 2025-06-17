<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $rating = Rating::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'rating' => $request->rating,
        ]);

        return response()->json([
            'message' => 'Rating berhasil ditambahkan',
            'data' => $rating
        ], 201);
    }
}

