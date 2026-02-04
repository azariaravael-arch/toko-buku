<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            Borrowing::create([
                'user_id' => $request->user_id,
                'book_id' => $request->book_id,
                'tanggal_pinjam' => now(),
                'tanggal_kembali' => now()->addDays(7),
            ]);

            Book::where('id', $request->book_id)
                ->decrement('stock');
        });

        return back()->with('success', 'Buku berhasil dipinjam');
    }
}
