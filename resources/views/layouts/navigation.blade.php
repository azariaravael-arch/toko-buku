<nav x-data="{ open: false }" class="glass-nav">
    <!-- Top Bar -->
    <div class="border-b border-gray-100 py-2 hidden sm:block">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center text-[10px] uppercase tracking-widest text-gray-500 font-semibold">
            <div class="flex gap-6">
                <span class="flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg> Can we help you?</span>
                <span class="flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                        </path>
                    </svg> +1 246-345-0695</span>
            </div>
            <div class="flex gap-4">
                <a href="#" class="hover:text-gray-900">Wishlist</a>
                <a href="#" class="hover:text-gray-900">My Account</a>
            </div>
        </div>
    </div>

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <div class="flex items-center flex-1">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <span class="text-2xl font-serif font-bold tracking-tighter text-gray-900">BOOK<span
                                class="text-primary-500 italic">WORM</span></span>
                    </a>
                </div>

                <!-- Main Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="text-xs uppercase tracking-widest font-bold">
                        {{ __('Home') }}
                    </x-nav-link>

                    @if(Auth::check() && Auth::user()->role !== 'siswa')
                        <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')"
                            class="text-xs uppercase tracking-widest font-bold">
                            {{ __('Categories') }}
                        </x-nav-link>
                        <x-nav-link :href="route('books.index')" :active="request()->routeIs('books.*')"
                            class="text-xs uppercase tracking-widest font-bold">
                            {{ __('Books') }}
                        </x-nav-link>
                    @endif

                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')"
                            class="text-xs uppercase tracking-widest font-bold">
                            {{ __('Users') }}
                        </x-nav-link>
                    @endif

                </div>
            </div>

            <!-- Search Bar (Centered impact) -->
            <div class="hidden md:flex flex-1 max-w-sm mx-8">
                <div class="relative w-full">
                    <input type="text" placeholder="Search by Keywords"
                        class="w-full bg-gray-50 border-none focus:ring-1 focus:ring-gray-200 rounded-none py-2 px-4 text-sm">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Right Actions -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 flex-1 justify-end gap-4">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}"
                        class="text-xs uppercase tracking-widest font-bold text-gray-700 hover:text-gray-900">Login</a>
                    <a href="{{ route('register') }}"
                        class="text-xs uppercase tracking-widest font-bold text-white bg-gray-900 px-4 py-2 hover:bg-gray-800 transition">Register</a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @if(Auth::check() && Auth::user()->role !== 'siswa')
                <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                    {{ __('Categories') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('books.index')" :active="request()->routeIs('books.*')">
                    {{ __('Books') }}
                </x-responsive-nav-link>
            @endif
        </div>
    </div>
</nav>