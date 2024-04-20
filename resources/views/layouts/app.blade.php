<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name')}}</title>
        <!-- condition page and it css -->
        @if (request()->routeIs('login'))
        <link rel="stylesheet" type="text/css" href="assets/css/loging.css">
        @else
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- FAVICONS ICON ============================================= -->
	    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />
	    <link rel="shortcut icon" type="image/x-icon" href="logo/logo.png" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        @endif
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')



            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif



            <!-- Page Content -->
            @isset($slot)
                    {{ $slot }}
                @else
                    <div class="container">
                        @yield('content')
                    </div>
                @endisset

        </div>
    </body>
</html>
