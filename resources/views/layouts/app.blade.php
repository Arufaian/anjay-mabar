<!DOCTYPE html>
<html data-theme="corporate" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="drawer lg:drawer-open">
        <input class="drawer-toggle" id="my-drawer-4" type="checkbox" />
        <div class="drawer-content">
            <!-- Navbar -->
            <x-navbar />

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-base-300">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="min-h-screen bg-base-300">
                {{ $slot }}
            </main>
        </div>

        <x-sidebar />

    </div>
    
    @stack('scripts')
</body>

</html>
