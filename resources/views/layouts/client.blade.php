<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div x-cloak x-data="sidebar()"
        @resize.window="
                        width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
                        if (width > 767) {
                            sidebarOpen = true
                        }else{
                            sidebarOpen = false
                        }
                        "
        class="relative flex items-start">
        @include('includes.sidebar-toggler')
        @include('includes.sidebar')

        <div :class="{ 'ms-0 md:ms-72': sidebarOpen, 'ms-0': !sidebarOpen }"
            class="flex-col w-full transition-all duration-100 md:flex md:flex-col min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="mx-auto py-4 px-4 mt-14 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            <!-- Page Content -->
            <main>
                <div class="mx-auto">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        function sidebar() {
            width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
            if (width > 767) {
                return {
                    sidebarOpen: true
                }
            } else {
                return {
                    sidebarOpen: false
                }
                sidebarOpen = false
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    @livewireScripts
</body>

</html>
