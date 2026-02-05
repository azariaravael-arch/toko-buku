<x-app-layout>
    <!-- Custom Layout for Welcome Page (Override standard spacing if needed) -->
    <div class="bg-white">
        <!-- Hero Section -->
        <div class="bg-[#F9F6F3] overflow-hidden">
            <div
                class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20 flex flex-col lg:flex-row items-center gap-12">
                <div class="flex-1 text-center lg:text-left">
                    <span class="text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400 mb-4 block">The Bookworm
                        Editors'</span>
                    <h1 class="text-5xl lg:text-7xl font-serif text-gray-900 leading-tight mb-8">
                        Featured Books of the <span class="italic text-primary-500">February</span>
                    </h1>
                    <a href="#featured" class="btn-primary">See More</a>
                </div>
                <div class="flex-1 relative flex justify-center lg:justify-end">
                    <!-- Decorative Circles (Modern background) -->
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-accent-peach/20 rounded-full blur-3xl -z-10">
                    </div>

                    <div class="flex -space-x-16 lg:-space-x-24">
                        @foreach($featuredBooks->take(3) as $index => $book)
                            <div
                                class="w-48 lg:w-64 rotate-[{{ $index % 2 == 0 ? '-5deg' : '5deg' }}] transform transition-transform hover:rotate-0 hover:z-50 shadow-2xl">
                                <img src="{{ $book->cover ? asset('storage/' . $book->cover) : 'https://placehold.co/400x600?text=' . urlencode($book->title) }}"
                                    class="w-full aspect-[3/4] object-cover border-4 border-white shadow-lg"
                                    alt="{{ $book->title }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Slider Indicators (Visual Only) -->
            <div class="flex justify-center gap-2 pb-8">
                <div class="w-2 h-2 rounded-full bg-gray-900"></div>
                <div class="w-2 h-2 rounded-full bg-gray-300"></div>
                <div class="w-2 h-2 rounded-full bg-gray-300"></div>
            </div>
        </div>

        <!-- Featured Categories -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="flex justify-between items-end mb-12">
                <h2 class="text-3xl font-serif">Featured Categories</h2>
                <a href="#" class="text-xs uppercase tracking-widest font-bold border-b-2 border-gray-900 pb-1">All
                    Categories &rarr;</a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @php
                    $colors = ['bg-accent-lavender', 'bg-accent-cream', 'bg-accent-peach', 'bg-accent-mint', 'bg-accent-peach'];
                    $icons = [
                        '<svg class="w-12 h-12 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>',
                        '<svg class="w-12 h-12 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>',
                        '<svg class="w-12 h-12 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>',
                        '<svg class="w-12 h-12 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.423 15.641a15.98 15.98 0 01-5.922 5.089m1.97-3.041a15.966 15.966 0 01-5.447-5.447m1.97 3.04a15.966 15.966 0 005.447-5.447m-3.477 8.487l-.423.423a1.732 1.732 0 002.448 2.448l.423-.423m-4.444-4.444l-.423.423a1.732 1.732 0 01-2.448-2.448l.423-.423m8.485-8.485l.423-.423a1.732 1.732 0 00-2.448-2.448l-.423.423m-4.444 4.444l.423-.423a1.732 1.732 0 012.448 2.448l-.423.423M15.823 15.823a16.03 16.03 0 01-5.447-5.447m3.477 8.487a16.03 16.03 0 01-8.487-3.477m8.487 3.477l.423-.423a1.732 1.732 0 00-2.448-2.448l-.423.423m-4.444-4.444l.423-.423a1.732 1.732 0 012.448 2.448l-.423.423m8.485-8.485l-.423.423a1.732 1.732 0 01-2.448-2.448l.423.423m4.444 4.444l-.423.423a1.732 1.732 0 002.448 2.448l.423-.423"></path></svg>',
                        '<svg class="w-12 h-12 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>',
                    ];
                @endphp
                @foreach($categories->take(5) as $index => $category)
                    <div class="card-category {{ $colors[$index % count($colors)] }}">
                        <div class="mb-2">{!! $icons[$index % count($icons)] !!}</div>
                        <h3 class="text-sm font-bold uppercase tracking-tight text-gray-900">{{ $category->name }}</h3>
                        <a href="#featured"
                            class="text-[10px] uppercase tracking-widest font-bold text-gray-500 hover:text-gray-900 transition">Explore</a>

                    </div>
                @endforeach
            </div>
        </div>

        <!-- Bestselling Books Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 bg-white">
            <div class="flex justify-between items-end mb-12">
                <h2 class="text-3xl font-serif">Bestselling Books</h2>
                <a href="#"
                    class="text-xs uppercase tracking-widest font-bold text-gray-400 hover:text-gray-900 transition">View
                    All &rarr;</a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($featuredBooks->take(5) as $book)
                    <div class="book-card group">
                        <div class="book-cover-wrapper">
                            <img src="{{ $book->cover ? asset('storage/' . $book->cover) : 'https://placehold.co/300x400?text=' . urlencode($book->title) }}"
                                class="book-cover" alt="{{ $book->title }}">
                            <!-- Hover Quick Action -->
                            <div
                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <button
                                    class="bg-white text-gray-900 p-3 rounded-full shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <span
                            class="text-[10px] uppercase font-bold text-primary-500 mb-1 block">{{ $book->category->name }}</span>
                        <h4 class="text-sm font-bold text-gray-900 line-clamp-1 mb-1">{{ $book->title }}</h4>
                        <p class="text-[11px] text-gray-400 font-medium mb-2">{{ $book->author }}</p>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold text-gray-900">Books Collection</span>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>

        <!-- Featured Books Tab Section (Simplified) -->
        <div id="featured" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <h2 class="text-4xl font-serif mb-8 text-center italic">Featured Books</h2>
            <div class="flex justify-center gap-8 mb-12 border-b border-gray-100 italic font-serif">
                <button class="pb-4 border-b-2 border-primary-500 text-gray-900">Featured</button>
                <button class="pb-4 text-gray-400 hover:text-gray-900 transition">Most Viewed</button>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6 text-left">
                @foreach($featuredBooks as $book)
                    <div class="book-card group scale-90">
                        <div class="book-cover-wrapper mb-3">
                            <img src="{{ $book->cover ? asset('storage/' . $book->cover) : 'https://placehold.co/300x400?text=' . urlencode($book->title) }}"
                                class="book-cover" alt="{{ $book->title }}">
                        </div>
                        <span
                            class="text-[9px] uppercase font-bold text-gray-400 mb-1 block">{{ $book->category->name }}</span>
                        <h4 class="text-xs font-bold text-gray-900 line-clamp-1 mb-0.5">{{ $book->title }}</h4>
                        <p class="text-[10px] text-gray-400 mb-1">{{ $book->author }}</p>
                        <span class="text-xs font-bold text-gray-900">Coming Soon</span>

                    </div>
                @endforeach
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-20 mt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="col-span-1 md:col-span-2">
                    <span class="text-2xl font-serif font-bold tracking-tighter mb-6 block">BOOK<span
                            class="text-primary-400 italic">WORM</span></span>
                    <p class="text-gray-400 text-sm max-w-sm leading-relaxed">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.
                    </p>
                </div>
                <div>
                    <h5 class="text-xs uppercase tracking-widest font-bold mb-6">Contact Us</h5>
                    <p class="text-gray-400 text-xs">121 Clear Water Bay Road,<br>Clear Water Bay, Kowloon<br>Hong Kong
                    </p>
                </div>
                <div>
                    <h5 class="text-xs uppercase tracking-widest font-bold mb-6">Explore</h5>
                    <ul class="text-gray-400 text-xs space-y-4">
                        <li><a href="#" class="hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition">My Account</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</x-app-layout>