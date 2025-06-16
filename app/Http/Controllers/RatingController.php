<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'stars' => 'required|integer|min:1|max:5',
        ]);

        $rating = Rating::updateOrCreate(
            ['user_id' => auth()->id(), 'book_id' => $validated['book_id']],
            ['stars' => $validated['stars']]
        );

        return response()->json([
            'message' => 'Rating berhasil disimpan!',
            'data' => $rating
        ]);
    }
}

