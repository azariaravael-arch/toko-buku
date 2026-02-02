<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-serif text-3xl text-gray-900 leading-tight">
                    {{ __('Edit') }} <span class="italic text-primary-500">Category</span>
                </h2>
                <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Update the theme for your library shelf.
                </p>
            </div>
            <a href="{{ route('categories.index') }}"
                class="text-xs uppercase tracking-widest font-bold text-gray-400 hover:text-gray-900 transition underline underline-offset-8">
                &larr; Back to Categories
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-100 shadow-xl p-8 lg:p-12 relative overflow-hidden">
                <!-- Decorative element -->
                <div class="absolute top-0 right-0 w-24 h-24 bg-accent-cream/20 rounded-bl-full -mr-12 -mt-12"></div>

                <form action="{{ route('categories.update', $category) }}" method="POST" class="relative">
                    @csrf
                    @method('PATCH')

                    <div class="space-y-8">
                        <div>
                            <label for="name"
                                class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-2 block">Category
                                Name</label>
                            <input id="name" name="name" type="text"
                                class="w-full bg-gray-50 border-none focus:ring-2 focus:ring-primary-500/20 rounded-none py-4 px-6 text-gray-900 font-serif text-xl placeholder:text-gray-200"
                                placeholder="e.g. Science Fiction, Classical Literature..."
                                value="{{ old('name', $category->name) }}" required>
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div
                            class="flex justify-end italic text-[10px] text-gray-300 uppercase tracking-widest font-bold">
                            Refining the organization of knowledge.
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="btn-primary w-full">
                                Update Category
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>