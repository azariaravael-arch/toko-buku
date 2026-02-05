<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Models\Book;
use App\Models\Category;

Route::get('/', function () {
    $featuredBooks = Book::with('category')
        ->orderBy('created_at', 'desc')
        ->limit(12)
        ->get();

    $categories = Category::orderBy('name')
        ->limit(5)
        ->get();

    return view('welcome', compact('featuredBooks', 'categories'));
});

Route::get('/dashboard', function () {
    $stats = [
        'total_books' => Book::count(),
        'total_categories' => Category::count(),
        'recent_books' => Book::with('category')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get(),
    ];

    return view('dashboard', compact('stats'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';



Route::middleware(['auth', 'role:admin|petugas'])->group(function () {
    Route::resource('categories', CategoryController::class);
});

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;

Route::middleware(['auth', 'role:admin|petugas'])->group(function () {
    Route::resource('books', BookController::class);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});

