<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-serif text-3xl text-gray-900 leading-tight">
                    {{ __('Library') }} <span class="italic text-primary-500">Catalog</span>
                </h2>
                <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Manage and explore your collection of
                    books.</p>
            </div>
            <a href="{{ route('books.create') }}" class="btn-primary">
                Add New Book
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-8 p-4 bg-green-50 border-l-4 border-green-400 text-green-700 text-sm font-semibold italic">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Books Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
                @foreach ($books as $book)
                    <div
                        class="book-card group p-4 bg-white border border-gray-100 shadow-sm hover:shadow-xl transition-all">
                        <div class="book-cover-wrapper mb-4">
                            <img src="{{ $book->cover ? asset('storage/' . $book->cover) : 'https://placehold.co/300x400?text=' . urlencode($book->title) }}"
                                class="book-cover" alt="{{ $book->title }}">

                            <!-- Action Overlay -->
                            <div
                                class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-3">
                                <a href="{{ route('books.edit', $book) }}"
                                    class="bg-white text-gray-900 px-4 py-2 text-[10px] uppercase font-bold tracking-widest hover:bg-gray-100 transition">
                                    Edit Details
                                </a>
                                <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-primary-500 text-white px-4 py-2 text-[10px] uppercase font-bold tracking-widest hover:bg-primary-600 transition"
                                        onclick="return confirm('Are you sure you want to remove this book?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="text-center">
                            <span
                                class="text-[10px] uppercase font-bold text-primary-500 mb-1 block">{{ $book->category->name }}</span>
                            <h4 class="text-sm font-bold text-gray-900 line-clamp-1 mb-1">{{ $book->title }}</h4>
                            <p class="text-[11px] text-gray-400 font-medium mb-3">{{ $book->author }}</p>

                            <div class="flex justify-between items-center border-t border-gray-50 pt-3">
                                <div class="text-left">
                                    <p class="text-[9px] uppercase text-gray-300 font-bold">Stock</p>
                                    <p class="text-sm font-serif font-bold text-gray-900">{{ $book->stock }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[9px] uppercase text-gray-300 font-bold">ISBN</p>
                                    <p class="text-[10px] font-mono text-gray-600">{{ $book->isbn }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($books->isEmpty())
                <div class="text-center py-20 bg-white border border-gray-100">
                    <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    <p class="text-gray-400 font-serif italic text-xl">No books found in the catalog.</p>
                    <a href="{{ route('books.create') }}"
                        class="mt-4 inline-block text-xs uppercase tracking-widest font-bold text-primary-500 border-b border-primary-500 pb-1">Start
                        by adding one &rarr;</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>