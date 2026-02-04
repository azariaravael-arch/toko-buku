<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-serif text-3xl text-gray-900 leading-tight">
                    {{ __('Categories') }} <span class="italic text-primary-500">Management</span>
                </h2>
                <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Manage and organize your book categories.</p>
            </div>
            <a href="{{ route('categories.create') }}" class="btn-primary">
                Add Category
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-8 p-4 bg-green-50 border-l-4 border-green-400 text-green-700 text-sm font-semibold italic">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white border border-gray-100 shadow-xl p-6 lg:p-8">
                <div class="flex flex-col gap-4">
                    @forelse($categories as $category)
                        <div class="flex items-center justify-between p-4 border border-gray-50 hover:shadow-md transition">
                            <div>
                                <h3 class="text-sm font-bold text-gray-900">{{ $category->name }}</h3>
                                @if($category->created_at)
                                    <p class="text-xs text-gray-400">Created: {{ $category->created_at->format('d M Y') }}</p>
                                @endif
                            </div>

                            <div class="flex items-center gap-2">
                                <a href="{{ route('categories.edit', $category) }}" class="text-xs uppercase tracking-widest font-bold text-gray-400 hover:text-gray-900 transition">Edit</a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs uppercase tracking-widest font-bold text-red-600 hover:text-red-800 transition">Delete</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <p class="text-gray-400 font-serif italic text-lg">No categories yet.</p>
                            <a href="{{ route('categories.create') }}" class="mt-4 inline-block text-xs uppercase tracking-widest font-bold text-primary-500 border-b border-primary-500 pb-1">Add a category &rarr;</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
