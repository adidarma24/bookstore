@extends('layouts.app')

@section('title', '🏆 Top Authors')

@section('content')
    <div class="container my-4">
        <h2 class="mb-4">🏆 Top 10 Most Famous Authors (Rating > 5)</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Author</th>
                        <th>Votes</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($authors as $index => $author)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $author->name }}</td>
                            <td>{{ $author->total_votes }}</td>
                            <td>{{ number_format($author->average_rating, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">No authors found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
