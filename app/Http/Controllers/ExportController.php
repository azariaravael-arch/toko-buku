<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Exports\BorrowingsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportExcel()
    {
        return Excel::download(new BorrowingsExport, 'borrowings.xlsx');
    }

    public function exportPdf()
    {
        $borrowings = Borrowing::with(['user', 'book'])->get();
        $pdf = Pdf::loadView('reports.borrowings_pdf', compact('borrowings'));
        return $pdf->download('borrowings.pdf');
    }
}
