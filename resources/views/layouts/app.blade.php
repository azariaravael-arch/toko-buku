<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Perpustakaan') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <header class="glass-nav px-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between py-4">
            <div class="flex items-center gap-4">
                <a href="/" class="flex items-center gap-2">
                    <x-application-logo class="w-8 h-8" />
                    <span class="font-serif font-bold text-lg">BOOK<span
                            class="text-primary-400 italic">WORM</span></span>
                </a>
                <nav class="hidden md:flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-700 hover:text-gray-900">Dashboard</a>
                    @else
                        <a href="/" class="text-sm text-gray-700 hover:text-gray-900">Dashboard</a>
                    @endauth

                    <a href="{{ route('categories.index') }}"
                        class="text-sm text-gray-700 hover:text-gray-900">Kategori</a>
                    <a href="{{ route('books.index') }}" class="text-sm text-gray-700 hover:text-gray-900">Buku</a>
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <a href="{{ route('users.index') }}" class="text-sm text-gray-700 hover:text-gray-900">Users</a>
                    @endif

                </nav>
            </div>

            <div>
                @auth
                    <span class="text-sm text-gray-600 mr-4">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-red-600">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 mr-2">Login</a>
                    <a href="{{ route('register') }}" class="text-sm text-primary-500">Register</a>
                @endauth
            </div>
        </div>
    </header>

    @if(isset($header))
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </div>
    @endif

    <main class="min-h-[65vh]">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            @isset($slot)
                {{ $slot }}
            @endisset
            @yield('content')
        </div>
    </main>

    <footer class="bg-gray-900 text-white py-8 mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-sm">
            &copy; {{ date('Y') }} BOOKWORM. All rights reserved.
        </div>
    </footer>
</body>

</html>