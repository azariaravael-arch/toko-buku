<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-serif text-3xl text-gray-900 leading-tight">
                    {{ __('User') }} <span class="italic text-primary-500">Management</span>
                </h2>
                <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Manage library staff and student
                    accounts.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('users.create') }}"
                    class="btn-primary text-[10px] py-2 px-4 shadow-sm hover:shadow-md transition-all">Add New User</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-400 text-green-700 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-400 text-red-700 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white border border-gray-100 shadow-sm overflow-hidden transition-all hover:shadow-md">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-8 py-5 text-[10px] uppercase tracking-widest font-bold text-gray-400">Name
                                </th>
                                <th class="px-8 py-5 text-[10px] uppercase tracking-widest font-bold text-gray-400">
                                    Email</th>
                                <th class="px-8 py-5 text-[10px] uppercase tracking-widest font-bold text-gray-400">Role
                                </th>
                                <th
                                    class="px-8 py-5 text-[10px] uppercase tracking-widest font-bold text-gray-400 text-right">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($users as $user)
                                <tr class="group hover:bg-gray-50/50 transition-colors">
                                    <td class="px-8 py-6">
                                        <div class="font-bold text-gray-900 text-sm">{{ $user->name }}</div>
                                    </td>
                                    <td class="px-8 py-6 text-sm text-gray-500">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-8 py-6">
                                        <span
                                            class="inline-flex px-3 py-1 text-[9px] font-bold uppercase tracking-wider rounded-full 
                                                {{ $user->role === 'admin' ? 'bg-accent-peach/50 text-orange-700' : ($user->role === 'petugas' ? 'bg-accent-lavender/50 text-purple-700' : 'bg-accent-mint/50 text-teal-700') }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        @if(Auth::id() !== $user->id)
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-[10px] uppercase tracking-widest font-bold text-red-400 hover:text-red-600 transition">Delete</button>
                                            </form>
                                        @else
                                            <span
                                                class="text-[10px] uppercase tracking-widest font-bold text-gray-300 italic">Current
                                                User</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>