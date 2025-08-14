<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Rating;

class RatingController extends Controller
{
    public function create()
    {
        // Ambil semua author dan semua buku untuk dropdown
        $authors = \App\Models\Author::all();
        $books = \App\Models\Book::all();
        return view('ratings.create', compact('authors', 'books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'score' => 'required|integer|min:1|max:10',
        ]);

        Rating::create($validated);

        return redirect()->back()->with('success', 'Rating berhasil ditambahkan!');
    }
}
