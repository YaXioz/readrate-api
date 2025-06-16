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
}

