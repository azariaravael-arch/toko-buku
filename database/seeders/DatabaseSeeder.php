<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Users
        User::create([
            'name' => 'Admin Library',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Staff Library',
            'email' => 'staff@example.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
        ]);

        User::create([
            'name' => 'John Student',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);

        // Create Categories
        $fiction = Category::create(['name' => 'Fiction']);
        $science = Category::create(['name' => 'Science']);
        $history = Category::create(['name' => 'History']);

        // Create Books
        Book::create([
            'category_id' => $fiction->id,
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
            'publisher' => 'Scribner',
            'year' => 1925,
            'isbn' => '9780743273565',
            'stock' => 10,
        ]);

        Book::create([
            'category_id' => $science->id,
            'title' => 'A Brief History of Time',
            'author' => 'Stephen Hawking',
            'publisher' => 'Bantam',
            'year' => 1988,
            'isbn' => '9780553380163',
            'stock' => 5,
        ]);
    }
}
