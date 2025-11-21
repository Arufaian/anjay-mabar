<!DOCTYPE html>
<html data-theme="corporate" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net" rel="preconnect">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="drawer lg:drawer-open">
        <input class="drawer-toggle" id="my-drawer-4" type="checkbox" />
        <div class="drawer-content">
            <!-- Navbar -->
            <nav class="navbar w-full bg-base-100 border-l border-base-300">

                <div class="flex items-center justify-between w-full  px-4">

                    <label class="btn btn-square btn-ghost" for="my-drawer-4" aria-label="open sidebar">
                        <x-lucide-menu class="h-6 w-6" />
                    </label>
                    <div class="px-4">
                        <a href="{{ route('dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current" />
                        </a>
                    </div>

                    <div class="avatar avatar-placeholder dropdown dropdown-end dropdown-bottom">
                        <div class="bg-secondary text-neutral-content w-11 rounded-full" role="button" tabindex="0">
                            <span>SY</span>
                        </div>

                        <ul class="dropdown-content menu bg-base-200 rounded-box w-40 shadow-sm mt-2" tabindex="-1">
                            <li>
                                <a class="flex justify-center items-center" href="{{ route('profile.edit') }}">
                                    <x-lucide-user class="w-4 h-4" />
                                    <span>Profile</span>
                                </a>
                            </li>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <li>
                                    <a class="flex justify-center items-center" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                        <x-lucide-log-out class="w-4 h-4" />
                                        <span>Logout</span>
                                    </a>
                                </li>

                            </form>

                        </ul>
                    </div>

                </div>

            </nav>

            <!-- Page Heading -->
            @isset($header)
                <header>
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="min-h-screen bg-base-300">
                {{ $slot }}
            </main>
        </div>

        <div class="drawer-side is-drawer-close:overflow-visible">
            <label class="drawer-overlay" for="my-drawer-4" aria-label="close sidebar"></label>
            <div class="flex min-h-full flex-col items-start bg-base-100 is-drawer-close:w-14 is-drawer-open:w-64">
                <!-- Sidebar content here -->
                <ul class="menu w-full grow">
                    <!-- Dashboard -->
                    <li>
                        <a class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Dashboard"
                            href="{{ route('dashboard') }}">
                            <!-- Dashboard icon -->
                            <svg class="my-1.5 inline-block size-4" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" stroke-linejoin="round" stroke-linecap="round" stroke-width="2"
                                fill="none" stroke="currentColor">
                                <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path>
                                <path
                                    d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z">
                                </path>
                            </svg>
                            <span class="is-drawer-close:hidden">Dashboard</span>
                        </a>
                    </li>

                    <!-- Profile -->
                    <li>
                        <a class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Profile"
                            href="{{ route('profile.edit') }}">
                            <!-- Profile icon -->
                            <svg class="my-1.5 inline-block size-4" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" stroke-linejoin="round" stroke-linecap="round" stroke-width="2"
                                fill="none" stroke="currentColor">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span class="is-drawer-close:hidden">Profile</span>
                        </a>
                    </li>

                    <!-- Logout -->
                    <li>
                        <form class="w-full" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="is-drawer-close:tooltip is-drawer-close:tooltip-right w-full text-left"
                                data-tip="Logout" type="submit">
                                <!-- Logout icon -->
                                <svg class="my-1.5 inline-block size-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" stroke-linejoin="round" stroke-linecap="round" stroke-width="2"
                                    fill="none" stroke="currentColor">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16,17 21,12 16,7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span class="is-drawer-close:hidden">Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>
