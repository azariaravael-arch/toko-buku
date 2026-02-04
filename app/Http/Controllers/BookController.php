<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|min:1000|max:'.date('Y'),
            'isbn' => 'required|string|max:50',
            'stock' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Book::create($data);

        return redirect()->route('books.index')
                         ->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|min:1000|max:'.date('Y'),
            'isbn' => 'required|string|max:50',
            'stock' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('cover')) {
            // remove old cover if exists
            if ($book->cover) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($book->cover);
            }

            $data['cover'] = $request->file('cover')->store('covers', 'public');
        } else {
            unset($data['cover']);
        }

        $book->update($data);

        return redirect()->route('books.index')
                         ->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy(Book $book)
    {
        if ($book->cover) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($book->cover);
        }

        $book->delete();

        return redirect()->route('books.index')
                         ->with('success', 'Buku berhasil dihapus');
    }
}
