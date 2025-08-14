<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    public function topAuthors()
    {
        // Ambil author dengan jumlah vote terbanyak dan rating > 5
        $authors = DB::table('authors')
            ->join('books', 'authors.id', '=', 'books.author_id')
            ->join('ratings', 'books.id', '=', 'ratings.book_id')
            ->select(
                'authors.id',
                'authors.name',
                DB::raw('COUNT(ratings.id) as total_votes'),
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->where('ratings.rating', '>', 5)
            ->groupBy('authors.id', 'authors.name')
            ->orderByDesc('total_votes')
            ->limit(10)
            ->get();

        return view('authors.top', compact('authors'));
    }
}
