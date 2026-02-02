<?php

namespace App\Exports;

use App\Models\Borrowing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BorrowingsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Borrowing::with(['user', 'book'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'User Name',
            'Book Title',
            'Borrow Date',
            'Return Date',
            'Actual Return Date',
            'Status',
            'Fine',
        ];
    }

    public function map($borrowing): array
    {
        return [
            $borrowing->id,
            $borrowing->user->name,
            $borrowing->book->title,
            $borrowing->borrow_date->format('Y-m-d'),
            $borrowing->return_date->format('Y-m-d'),
            $borrowing->actual_return_date ? $borrowing->actual_return_date->format('Y-m-d') : '-',
            $borrowing->status,
            $borrowing->fine,
        ];
    }
}
