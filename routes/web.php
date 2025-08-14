<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

// Halaman awal
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/authors/top', [AuthorController::class, 'topAuthors'])->name('authors.top');
Route::get('/ratings/create', [RatingController::class, 'create'])->name('ratings.create');
Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
