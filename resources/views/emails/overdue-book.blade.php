<x-mail::message>
    # Buku Terlambat Dikembalikan

    Halo {{ $borrowing->user->name }},

    Buku yang Anda pinjam telah melewati batas waktu pengembalian.

    **Detail Peminjaman:**
    - **Buku:** {{ $borrowing->book->title }}
    - **Tanggal Pinjam:** {{ $borrowing->borrow_date->format('d M Y') }}
    - **Batas Kembali:** {{ $borrowing->return_date->format('d M Y') }}

    Mohon segera mengembalikan buku tersebut ke perpustakaan untuk menghindari penambahan denda.

    Terima kasih,<br>
    {{ config('app.name') }}
</x-mail::message>