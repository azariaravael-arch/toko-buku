<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-serif text-3xl text-gray-900 leading-tight">
                    {{ __('Shelf') }} <span class="italic text-primary-500">Categories</span>
                </h2>
                <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Organize your library by genres and
                    topics.</p>
            </div>
            <a href="{{ route('categories.create') }}" class="btn-primary">
                Add Category
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

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($categories as $index => $category)
                    @php
                        $colors = ['bg-accent-lavender', 'bg-accent-cream', 'bg-accent-peach', 'bg-accent-mint'];
                        $currentColor = $colors[$index % count($colors)];
                    @endphp
                    <div class="bg-white border border-gray-100 shadow-sm transition-all hover:shadow-md group">
                        <div class="p-8">
                            <div class="flex items-center justify-between mb-6">
                                <div class="w-12 h-12 {{ $currentColor }} rounded-full flex items-center justify-center">
                                    <span
                                        class="text-gray-900 font-serif font-bold text-xl">{{ substr($category->name, 0, 1) }}</span>
                                </div>
                                <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('categories.edit', $category) }}"
                                        class="text-gray-400 hover:text-gray-900 transition p-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                            </path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-300 hover:text-red-500 transition p-2"
                                            onclick="return confirm('Are you sure?')">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <h3 class="text-xl font-serif font-bold text-gray-900 mb-2">{{ $category->name }}</h3>
                            <p class="text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">Total Books:
                                {{ $category->books_count ?? '0' }}</p>
                        </div>
                        <div class="h-1 {{ $currentColor }}"></div>
                    </div>
                @endforeach
            </div>

            @if($categories->isEmpty())
                <div class="text-center py-20 bg-white border border-gray-100">
                    <p class="text-gray-400 font-serif italic text-xl">No categories defined yet.</p>
                    <a href="{{ route('categories.create') }}"
                        class="mt-4 inline-block text-xs uppercase tracking-widest font-bold text-primary-500 border-b border-primary-500 pb-1">Create
                        one &rarr;</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>