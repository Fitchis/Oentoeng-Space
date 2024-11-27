<nav x-data="{ open: false, theme: 'light' }" class="bg-gray-900 border-b border-gray-800 shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <button id="theme-toggle" @click="theme = theme === 'dark' ? 'light' : 'dark'"
                    class="relative flex w-12 h-6 bg-gray-700 rounded-full transition duration-300">
                    <svg x-show="theme === 'dark'" class="absolute left-0 w-5 h-5 text-white transition-all duration-500"
                        fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4.5a7.5 7.5 0 100 15 7.5 7.5 0 000-15z" />
                    </svg>
                    <svg x-show="theme === 'light'"
                        class="absolute right-0 w-5 h-5 text-yellow-400 transition-all duration-500" fill="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2a10 10 0 110 20 10 10 0 010-20z" />
                    </svg>
                    <div class="absolute w-6 h-6 bg-gray-300 rounded-full transition-all duration-500"
                        :class="theme === 'dark' ? 'translate-x-6' : 'translate-x-0'"></div>
                </button>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-yellow-400">
                        {{ __('Cek Bookingan') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')" class="text-white hover:text-yellow-400">
                        {{ __('Home') }}
                    </x-nav-link>
                </div>
            </div>
            <h2 class="font-extrabold text-white items-center text-xl md:text-2xl lg:text-3xl tracking-wide uppercase">
                Oentoeng Space
            </h2>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-gray-700 text-sm leading-4 font-medium rounded-md text-white bg-gray-800 hover:bg-gray-700 focus:outline-none transition ease-in-out duration-150">
                            @if (Auth::check())
                                <div>{{ Auth::user()->name }}</div>
                            @else
                                <div>Guest</div>
                            @endif

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
                        @if (Auth::check())
                            <x-dropdown-link :href="route('profile.edit')" class="text-gray-300 hover:text-gray-900">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Auth::user()->usertype === 'admin')
                                <x-dropdown-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                                    class="text-gray-300 hover:text-gray-900">
                                    {{ __('Dashboard') }}
                                </x-dropdown-link>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-red-500 hover:text-red-400">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        @else
                            <x-dropdown-link :href="route('login')" class="text-gray-300 hover:text-gray-200">
                                {{ __('Login') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('register')" class="text-gray-300 hover:text-gray-200">
                                {{ __('Register') }}
                            </x-dropdown-link>
                        @endif
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-300 hover:text-yellow-400">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')" class="text-gray-300 hover:text-yellow-400">
                {{ __('Home') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4">
                @if (Auth::check())
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                @else
                    <div class="font-medium text-base text-white">Guest</div>
                @endif
            </div>

            <div class="mt-3 space-y-1">
                @if (Auth::check())
                    <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-300 hover:text-yellow-400">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-400">Logout</button>
                    </form>
                @else
                    <x-responsive-nav-link :href="route('login')" class="text-gray-300 hover:text-yellow-400">
                        {{ __('Login') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('register')" class="text-gray-300 hover:text-yellow-400">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                @endif
            </div>
        </div>
    </div>
</nav>
