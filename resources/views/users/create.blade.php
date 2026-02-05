<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-serif text-3xl text-gray-900 leading-tight">
                    {{ __('Create') }} <span class="italic text-primary-500">New User</span>
                </h2>
                <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Register a new member of the library.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-100 shadow-sm p-8 transition-all hover:shadow-md">
                <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')"
                            class="text-[10px] uppercase tracking-widest font-bold text-gray-400" />
                        <x-text-input id="name"
                            class="block mt-1 w-full border-gray-100 focus:border-primary-500 focus:ring-primary-500 rounded-none bg-gray-50"
                            type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')"
                            class="text-[10px] uppercase tracking-widest font-bold text-gray-400" />
                        <x-text-input id="email"
                            class="block mt-1 w-full border-gray-100 focus:border-primary-500 focus:ring-primary-500 rounded-none bg-gray-50"
                            type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Role -->
                    <div>
                        <x-input-label for="role" :value="__('Role')"
                            class="text-[10px] uppercase tracking-widest font-bold text-gray-400" />
                        <select id="role" name="role"
                            class="block mt-1 w-full border-gray-100 focus:border-primary-500 focus:ring-primary-500 rounded-none bg-gray-50 text-sm">
                            <option value="siswa" {{ old('role') === 'siswa' ? 'selected' : '' }}>Siswa</option>
                            <option value="petugas" {{ old('role') === 'petugas' ? 'selected' : '' }}>Petugas (Staff)
                            </option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')"
                            class="text-[10px] uppercase tracking-widest font-bold text-gray-400" />
                        <x-text-input id="password"
                            class="block mt-1 w-full border-gray-100 focus:border-primary-500 focus:ring-primary-500 rounded-none bg-gray-50"
                            type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                            class="text-[10px] uppercase tracking-widest font-bold text-gray-400" />
                        <x-text-input id="password_confirmation"
                            class="block mt-1 w-full border-gray-100 focus:border-primary-500 focus:ring-primary-500 rounded-none bg-gray-50"
                            type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-8 gap-4">
                        <a href="{{ route('users.index') }}"
                            class="text-[10px] uppercase tracking-widest font-bold text-gray-400 hover:text-gray-900 transition">Cancel</a>
                        <x-primary-button class="btn-primary border-none shadow-sm hover:shadow-md">
                            {{ __('Create User') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>