<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-serif text-3xl text-gray-900 leading-tight">
                    {{ __('Welcome back,') }} <span class="italic text-primary-500">{{ Auth::user()->name }}</span>
                </h2>
                <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Here is what's happening in your library
                    today.</p>
            </div>
            @if(Auth::user()->role !== 'siswa')
                <div class="flex gap-2">
                    <a href="{{ route('books.create') }}" class="btn-primary text-[10px] py-2 px-4">Add New Book</a>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            @if(Auth::user()->role !== 'siswa')
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    <div class="bg-white p-8 border border-gray-100 shadow-sm transition-all hover:shadow-md">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-accent-peach/30 rounded-full">
                                <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-widest font-bold text-gray-400">Total Books</p>
                                <p class="text-3xl font-serif font-bold text-gray-900">{{ $stats['total_books'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-8 border border-gray-100 shadow-sm transition-all hover:shadow-md">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-accent-lavender/30 rounded-full">
                                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-widest font-bold text-gray-400">Categories</p>
                                <p class="text-3xl font-serif font-bold text-gray-900">{{ $stats['total_categories'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-white p-8 border border-gray-100 shadow-sm transition-all hover:shadow-md md:col-span-2 lg:col-span-1">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-accent-mint/30 rounded-full">
                                <svg class="w-6 h-6 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-widest font-bold text-gray-400">Staff Role</p>
                                <p class="text-sm font-bold text-gray-900 uppercase tracking-widest">
                                    {{ Auth::user()->role }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Recent Activity/Books -->
                <div class="flex-1">
                    <div class="bg-white border border-gray-100 shadow-sm overflow-hidden">
                        <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center">
                            <h3 class="text-xl font-serif">Recently Added Books</h3>
                            <a href="{{ route('books.index') }}"
                                class="text-[10px] uppercase tracking-widest font-bold text-primary-500">View All</a>
                        </div>
                        <div class="divide-y divide-gray-50">
                            @foreach($stats['recent_books'] as $book)
                                <div class="p-8 flex items-center gap-6 group">
                                    <div class="w-16 h-20 bg-gray-100 overflow-hidden shadow-sm flex-shrink-0">
                                        <img src="{{ $book->cover ? asset('storage/' . $book->cover) : 'https://placehold.co/100x120?text=' . urlencode($book->title) }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-[9px] uppercase font-bold text-primary-500 mb-1">
                                            {{ $book->category->name }}</p>
                                        <h4 class="text-sm font-bold text-gray-900">{{ $book->title }}</h4>
                                        <p class="text-[11px] text-gray-400">{{ $book->author }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[10px] uppercase text-gray-300 font-bold mb-1">Stock</p>
                                        <p class="text-lg font-serif font-bold text-gray-900">{{ $book->stock }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Quick Tips/Support -->
                <div class="w-full lg:w-80">
                    <div class="bg-gray-900 text-white p-8 relative overflow-hidden">
                        <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-primary-500/10 rounded-full blur-2xl">
                        </div>
                        <h3 class="text-xl font-serif mb-4 italic">Librarian <br>Pro Tip</h3>
                        <p class="text-xs text-gray-400 leading-relaxed mb-6">Keep your book descriptions concise and
                            always include high-quality cover images for a better browsing experience.</p>
                        <a href="{{ route('books.create') }}"
                            class="text-[10px] uppercase tracking-[0.2em] font-bold text-primary-500 border-b border-primary-500 pb-1">Get
                            Started &rarr;</a>
                    </div>

                    <div class="mt-8 bg-accent-cream p-8">
                        <h3 class="text-sm font-bold uppercase tracking-widest text-gray-900 mb-4">Quick Links</h3>
                        <ul class="space-y-4 text-xs font-semibold text-gray-500">
                            <li><a href="{{ route('profile.edit') }}" class="hover:text-gray-900 transition">Edit My
                                    Profile</a></li>
                            @if(Auth::user()->role !== 'siswa')
                                <li><a href="{{ route('categories.create') }}" class="hover:text-gray-900 transition">Manage
                                        Categories</a></li>
                            @endif
                            <li><a href="/" class="hover:text-gray-900 transition">Landing Page</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>