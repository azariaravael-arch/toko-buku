<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Borrow a Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('borrowings.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <x-input-label for="book_id" :value="__('Select Book')" />
                                <select id="book_id" name="book_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    @foreach($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->title }} (Stock: {{ $book->stock }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('book_id')" />
                            </div>

                            <div>
                                <x-input-label for="borrow_date" :value="__('Borrow Date')" />
                                <x-text-input id="borrow_date" name="borrow_date" type="date" class="mt-1 block w-full"
                                    :value="old('borrow_date', date('Y-m-d'))" required />
                                <x-input-error class="mt-2" :messages="$errors->get('borrow_date')" />
                            </div>

                            <div>
                                <x-input-label for="return_date" :value="__('Return Date')" />
                                <x-text-input id="return_date" name="return_date" type="date" class="mt-1 block w-full"
                                    :value="old('return_date')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('return_date')" />
                                <p class="text-xs text-gray-500 mt-1">Standard loan period is 7 days.</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 mt-6">
                            <x-primary-button>{{ __('Borrow') }}</x-primary-button>
                            <a href="{{ route('borrowings.index') }}"
                                class="text-sm text-gray-600 hover:text-gray-900">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Set default return date to 7 days from today
        document.addEventListener('DOMContentLoaded', function () {
            const borrowDateInput = document.getElementById('borrow_date');
            const returnDateInput = document.getElementById('return_date');

            function updateReturnDate() {
                if (borrowDateInput.value) {
                    const borrowDate = new Date(borrowDateInput.value);
                    const returnDate = new Date(borrowDate);
                    returnDate.setDate(borrowDate.getDate() + 7);
                    returnDateInput.value = returnDate.toISOString().split('T')[0];
                }
            }

            borrowDateInput.addEventListener('change', updateReturnDate);
            if (!returnDateInput.value) {
                updateReturnDate();
            }
        });
    </script>
</x-app-layout>