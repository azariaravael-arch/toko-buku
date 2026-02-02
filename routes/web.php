<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categories = \App\Models\Category::all();
    $featuredBooks = \App\Models\Book::with('category')->latest()->take(10)->get();
    return view('welcome', compact('categories', 'featuredBooks'));
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $stats = [
            'total_books' => \App\Models\Book::count(),
            'total_categories' => \App\Models\Category::count(),
            'recent_books' => \App\Models\Book::with('category')->latest()->take(5)->get(),
        ];
        return view('dashboard', compact('stats'));
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin & Petugas only (Management)
    Route::middleware(['role:admin,petugas'])->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('books', BookController::class);
    });
});

require __DIR__ . '/auth.php';
