<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'book'])->get();
        if (Auth::user()->role === 'siswa') {
            $borrowings = $borrowings->where('user_id', Auth::id());
        }
        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $books = Book::where('stock', '>', 0)->get();
        return view('borrowings.create', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:borrow_date',
        ]);

        $book = Book::find($request->book_id);
        if ($book->stock <= 0) {
            return back()->with('error', 'Book is out of stock.');
        }

        Borrowing::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'borrow_date' => $request->borrow_date,
            'return_date' => $request->return_date,
            'status' => 'borrowed',
        ]);

        $book->decrement('stock');

        return redirect()->route('borrowings.index')
            ->with('success', 'Book borrowed successfully.');
    }

    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'borrowed') {
            return back()->with('error', 'Book already returned.');
        }

        $now = Carbon::now();
        $returnDate = Carbon::parse($borrowing->return_date);
        $fine = 0;

        if ($now->greaterThan($returnDate)) {
            $daysLate = $now->diffInDays($returnDate);
            $fine = $daysLate * 1000; // 1000 per day
        }

        $borrowing->update([
            'actual_return_date' => $now,
            'status' => 'returned',
            'fine' => $fine,
        ]);

        $borrowing->book->increment('stock');

        return redirect()->route('borrowings.index')
            ->with('success', 'Book returned successfully. Fine: ' . $fine);
    }
}
