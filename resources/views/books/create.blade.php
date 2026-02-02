<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-serif text-3xl text-gray-900 leading-tight">
                    {{ __('Add New') }} <span class="italic text-primary-500">Masterpiece</span>
                </h2>
                <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Fill in the details to expand your
                    library collection.</p>
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
                <div class="absolute top-0 right-0 w-32 h-32 bg-accent-peach/20 rounded-bl-full -mr-16 -mt-16"></div>

                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="relative">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="col-span-1 md:col-span-2">
                            <label for="title"
                                class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-2 block">Book
                                Title</label>
                            <input id="title" name="title" type="text"
                                class="w-full bg-gray-50 border-none focus:ring-2 focus:ring-primary-500/20 rounded-none py-4 px-6 text-gray-900 font-serif text-xl placeholder:text-gray-200"
                                placeholder="Enter the title of the book..." value="{{ old('title') }}" required>
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <label for="category_id"
                                class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-2 block">Category</label>
                            <select id="category_id" name="category_id"
                                class="w-full bg-gray-50 border-none focus:ring-2 focus:ring-primary-500/20 rounded-none py-4 px-6 text-gray-900 text-sm font-semibold">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                                value="{{ old('author') }}" required>
                            <x-input-error class="mt-2" :messages="$errors->get('author')" />
                        </div>

                        <div>
                            <label for="publisher"
                                class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-2 block">Publisher</label>
                            <input id="publisher" name="publisher" type="text"
                                class="w-full bg-gray-50 border-none focus:ring-2 focus:ring-primary-500/20 rounded-none py-4 px-6 text-gray-900 text-sm font-semibold"
                                value="{{ old('publisher') }}" required>
                            <x-input-error class="mt-2" :messages="$errors->get('publisher')" />
                        </div>

                        <div>
                            <label for="year"
                                class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-2 block">Publication
                                Year</label>
                            <input id="year" name="year" type="number"
                                class="w-full bg-gray-50 border-none focus:ring-2 focus:ring-primary-500/20 rounded-none py-4 px-6 text-gray-900 text-sm font-semibold"
                                value="{{ old('year', date('Y')) }}" required>
                            <x-input-error class="mt-2" :messages="$errors->get('year')" />
                        </div>

                        <div>
                            <label for="isbn"
                                class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-2 block">ISBN
                                Number</label>
                            <input id="isbn" name="isbn" type="text"
                                class="w-full bg-gray-50 border-none focus:ring-2 focus:ring-primary-500/20 rounded-none py-4 px-6 text-gray-900 text-sm font-semibold font-mono"
                                value="{{ old('isbn') }}" required>
                            <x-input-error class="mt-2" :messages="$errors->get('isbn')" />
                        </div>

                        <div>
                            <label for="stock"
                                class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-2 block">Initial
                                Stock</label>
                            <input id="stock" name="stock" type="number"
                                class="w-full bg-gray-50 border-none focus:ring-2 focus:ring-primary-500/20 rounded-none py-4 px-6 text-gray-900 text-sm font-semibold"
                                value="{{ old('stock', 0) }}" required>
                            <x-input-error class="mt-2" :messages="$errors->get('stock')" />
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label for="cover"
                                class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-4 block">Cover
                                Masterpiece (Image)</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="cover"
                                    class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-100 border-dashed rounded-none cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                            </path>
                                        </svg>
                                        <p class="mb-2 text-xs text-gray-500 italic"><span class="font-bold">Click to
                                                upload</span> or drag and drop</p>
                                        <p class="text-[9px] text-gray-400 uppercase tracking-widest">PNG, JPG or GIF
                                            (MAX. 2MB)</p>
                                    </div>
                                    <input id="cover" name="cover" type="file" class="hidden" />
                                </label>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('cover')" />
                        </div>
                    </div>

                    <div class="mt-12 flex justify-end">
                        <button type="submit" class="btn-primary w-full md:w-auto">
                            Add to Catalog
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>