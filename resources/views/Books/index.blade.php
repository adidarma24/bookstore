@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>📚 Top Books</h2>

        {{-- Filter Form --}}
        <form method="GET" class="row mb-3">
            <div class="col-md-3">
                <select name="per_page" class="form-control" onchange="this.form.submit()">
                    @foreach ([10, 20, 30, 40, 50, 60, 70, 80, 90, 100] as $num)
                        <option value="{{ $num }}" {{ $perPage == $num ? 'selected' : '' }}>
                            Show {{ $num }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <input type="text" name="search" value="{{ $search }}" class="form-control"
                    placeholder="Search book or author...">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary">Search</button>
            </div>
        </form>

        <div class="mb-3">
            <a href="{{ route('ratings.create') }}" class="btn btn-primary">
                + Input Rating
            </a>
        </div>
        {{-- Table --}}
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Book</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Avg Rating</th>
                    <th>Voter</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $index => $book)
                    <tr>
                        <td>{{ $books->firstItem() + $index }}</td>
                        <td>{{ $book->book_title }}</td>
                        <td>{{ $book->category_name }}</td>
                        <td>{{ $book->author_name }}</td>
                        <td>{{ number_format($book->avg_rating, 2) }}</td>
                        <td>{{ $book->voter_count }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No books found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $books->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
