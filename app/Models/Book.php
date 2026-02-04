<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'year',
        'isbn',
        'stock',
        'category_id',
        'cover',
    ];

    /**
     * Relasi:
     * 1 buku punya 1 kategori
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi:
     * 1 buku bisa dipinjam berkali-kali
     */
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
