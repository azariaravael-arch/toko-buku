<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-serif text-3xl text-gray-900 leading-tight">
                    {{ __('Edit') }} <span class="italic text-primary-500">Masterpiece</span>
                </h2>
                <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Refine the details of your library
                    collection item.</p>
            </div>
            <a href="{{ route('books.index') }}"
                class="text-xs uppercase tracking-widest font-bold text-gray-400 hover:text-gray-900 transition underline underline-offset-8">
                &larr; Back to Catalog
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-100 shadow-xl p-8 lg:p-12 relative overflow-hidden">
                <!-- Decorative element -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-accent-lavender/20 rounded-bl-full -mr-16 -mt-16"></div>

                <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data"
                    class="relative">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                        <!-- Current Cover Preview -->
                        <div class="col-span-1">
                            <label
                                class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-4 block text-center lg:text-left">Current
                                Masterpiece</label>
                            <div
                                class="aspect-[3/4] bg-gray-50 border border-gray-100 shadow-lg overflow-hidden relative group">
                                <img id="cover-preview"
                                    src="{{ $book->cover ? asset('storage/' . $book->cover) : 'https://placehold.co/300x400?text=No+Cover' }}"
                                    class="w-full h-full object-cover transition-transform group-hover:scale-105 duration-500"
                                    alt="{{ $book->title }}">
                                <div
                                    class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <label for="cover"
                                        class="cursor-pointer text-white text-[10px] uppercase tracking-widest font-bold border border-white px-4 py-2 hover:bg-white hover:text-black transition">Change
                                        Cover</label>
                                </div>
                            </div>
                            <input id="cover" name="cover" type="file" class="hidden" />
                            <x-input-error class="mt-2" :messages="$errors->get('cover')" />
                        </div>

                        <!-- Form Fields -->
                        <div class="col-span-1 md:col-span-2 space-y-8">
                            <div>
                                <label for="title"
                                    class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-2 block">Book
                                    Title</label>
                                <input id="title" name="title" type="text"
                                    class="w-full bg-gray-50 border-none focus:ring-2 focus:ring-primary-500/20 rounded-none py-4 px-6 text-gray-900 font-serif text-xl placeholder:text-gray-200"
                                    placeholder="Enter the title of the book..."
                                    value="{{ old('title', $book->title) }}" required>
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                                <div>
                                    <label for="category_id"
                                        class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-2 block">Category</label>
                                    <select id="category_id" name="category_id"
                                        class="w-full bg-gray-50 border-none focus:ring-2 focus:ring-primary-500/20 rounded-none py-4 px-6 text-gray-900 text-sm font-semibold">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                                </div>

                                <div>
                                    <label for="author"
                                        class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-2 block">Author
                                        Name</label>
                                    <input id="author" name="author" type="text"
                                        class="w-full bg-gray-50 border-none focus:ring-2 focus:ring-primary-500/20 rounded-none py-4 px-6 text-gray-900 text-sm font-semibold"
                                        value="{{ old('author', $book->author) }}" required>
                                    <x-input-error class="mt-2" :messages="$errors->get('author')" />
                                </div>

                                <div>
                                    <label for="publisher"
                                        class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-2 block">Publisher</label>
                                    <input id="publisher" name="publisher" type="text"
                                        class="w-full bg-gray-50 border-none focus:ring-2 focus:ring-primary-500/20 rounded-none py-4 px-6 text-gray-900 text-sm font-semibold"
                                        value="{{ old('publisher', $book->publisher) }}" required>
                                    <x-input-error class="mt-2" :messages="$errors->get('publisher')" />
                                </div>

                                <div>
                                    <label for="year"
                                        class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-2 block">Publication
                                        Year</label>
                                    <input id="year" name="year" type="number"
                                        class="w-full bg-gray-50 border-none focus:ring-2 focus:ring-primary-500/20 rounded-none py-4 px-6 text-gray-900 text-sm font-semibold"
                                        value="{{ old('year', $book->year) }}" required>
                                    <x-input-error class="mt-2" :messages="$errors->get('year')" />
                                </div>

                                <div>
                                    <label for="isbn"
                                        class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-2 block">ISBN
                                        Number</label>
                                    <input id="isbn" name="isbn" type="text"
                                        class="w-full bg-gray-50 border-none focus:ring-2 focus:ring-primary-500/20 rounded-none py-4 px-6 text-gray-900 text-sm font-semibold font-mono"
                                        value="{{ old('isbn', $book->isbn) }}" required>
                                    <x-input-error class="mt-2" :messages="$errors->get('isbn')" />
                                </div>

                                <div>
                                    <label for="stock"
                                        class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-2 block">Current
                                        Stock</label>
                                    <input id="stock" name="stock" type="number"
                                        class="w-full bg-gray-50 border-none focus:ring-2 focus:ring-primary-500/20 rounded-none py-4 px-6 text-gray-900 text-sm font-semibold"
                                        value="{{ old('stock', $book->stock) }}" required>
                                    <x-input-error class="mt-2" :messages="$errors->get('stock')" />
                                </div>
                            </div>

                            <div class="mt-12 flex justify-end gap-4">
                                <button type="submit" class="btn-primary flex-1 md:flex-none">
                                    Update Masterpiece
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>