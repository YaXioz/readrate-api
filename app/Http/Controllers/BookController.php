<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if ($search = $request->query('search')) {
            $query->where('title', 'like', "%$search%")
                  ->orWhere('author', 'like', "%$search%");
        }

        return response()->json($query->paginate(10));
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return response()->json($book);
    }
    public function uploadCover(Request $request, $id)
    {
        $request->validate([
            'cover' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $book = Book::findOrFail($id);

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public');
            $book->cover_url = '/storage/' . $path;
            $book->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Cover uploaded successfully',
            'path' => $path,
            'url' => asset('storage/' . $path) // ini akan hasilkan http://localhost:8000/storage/...
        ]);

    }
}

