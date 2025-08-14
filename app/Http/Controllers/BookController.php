<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');

        $books = DB::table('books')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->leftJoin('ratings', 'books.id', '=', 'ratings.book_id')
            ->select(
                'books.id',
                'books.title as book_title',
                'categories.name as category_name',
                'authors.name as author_name',
                DB::raw('AVG(ratings.rating) as avg_rating'),
                DB::raw('COUNT(ratings.id) as voter_count')
            )
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('books.title', 'like', "%$search%")
                        ->orWhere('authors.name', 'like', "%$search%");
                });
            })
            ->groupBy('books.id', 'books.title', 'categories.name', 'authors.name')
            ->orderByDesc('avg_rating')
            ->paginate($perPage);

        return view('books.index', compact('books', 'perPage', 'search'));
    }
}
