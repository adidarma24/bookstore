@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Insert Rating</h2>

        <div class="card shadow-sm p-4">
            <form action="{{ route('ratings.store') }}" method="POST">
                @csrf

                {{-- Book Author --}}
                <div class="mb-3">
                    <label for="author_id" class="form-label">Book Author</label>
                    <select name="author_id" id="author_id" class="form-select" required>
                        <option value="">-- Select Author --</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Book Name --}}
                <div class="mb-3">
                    <label for="book_id" class="form-label">Book Name</label>
                    <select name="book_id" id="book_id" class="form-select" required>
                        <option value="">-- Select Book --</option>
                        {{-- Data buku akan terfilter berdasarkan author --}}
                    </select>
                </div>

                {{-- Rating --}}
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating</label>
                    <select name="rating" id="rating" class="form-select" required>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                {{-- Submit Button --}}
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
    </div>

    {{-- Script untuk filter Book berdasarkan Author --}}
    <script>
        document.getElementById('author_id').addEventListener('change', function() {
            const authorId = this.value;
            const bookSelect = document.getElementById('book_id');

            // Kosongkan pilihan buku
            bookSelect.innerHTML = '<option value="">-- Select Book --</option>';

            if (authorId) {
                fetch(`/api/books-by-author/${authorId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(book => {
                            const option = document.createElement('option');
                            option.value = book.id;
                            option.text = book.title;
                            bookSelect.appendChild(option);
                        });
                    });
            }
        });
    </script>
@endsection
