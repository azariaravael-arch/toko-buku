<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Rename category field
        if (Schema::hasTable('categories') && Schema::hasColumn('categories', 'nama')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->renameColumn('nama', 'name');
            });
        }

        // Rename book fields
        if (Schema::hasTable('books')) {
            Schema::table('books', function (Blueprint $table) {
                if (Schema::hasColumn('books', 'judul')) {
                    $table->renameColumn('judul', 'title');
                }
                if (Schema::hasColumn('books', 'penulis')) {
                    $table->renameColumn('penulis', 'author');
                }
                if (Schema::hasColumn('books', 'penerbit')) {
                    $table->renameColumn('penerbit', 'publisher');
                }
                if (Schema::hasColumn('books', 'tahun')) {
                    $table->renameColumn('tahun', 'year');
                }
                if (Schema::hasColumn('books', 'stok')) {
                    $table->renameColumn('stok', 'stock');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('categories') && Schema::hasColumn('categories', 'name')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->renameColumn('name', 'nama');
            });
        }

        if (Schema::hasTable('books')) {
            Schema::table('books', function (Blueprint $table) {
                if (Schema::hasColumn('books', 'title')) {
                    $table->renameColumn('title', 'judul');
                }
                if (Schema::hasColumn('books', 'author')) {
                    $table->renameColumn('author', 'penulis');
                }
                if (Schema::hasColumn('books', 'publisher')) {
                    $table->renameColumn('publisher', 'penerbit');
                }
                if (Schema::hasColumn('books', 'year')) {
                    $table->renameColumn('year', 'tahun');
                }
                if (Schema::hasColumn('books', 'stock')) {
                    $table->renameColumn('stock', 'stok');
                }
            });
        }
    }
};