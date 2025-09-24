<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Basic Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title Meta -->
    <title>Mini Medical Shop | Laravel</title>
    <meta name="description" content="@yield('meta_description', 'Welcome to ' . config('app.name', 'Laravel') . ', your trusted online medical shop.')">
    <meta name="keywords" content="@yield('meta_keywords', 'medical shop, pharmacy, healthcare, products, medicine, devices')">

    <!-- Open Graph (for social sharing) -->
    <meta property="og:title" content="Mini Medical Shop | Laravel">
    <meta property="og:description" content="@yield('og_description', 'Shop medicines, devices, and healthcare products easily.')">
    <meta property="og:image" content="@yield('og_image', asset('storage/images/og-default.png'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Mini Medical Shop | Laravel">
    <meta name="twitter:description" content="@yield('twitter_description', 'Trusted medical shop for all your healthcare needs.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('storage/images/og-default.png'))">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Css & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Flash Messages -->
        @if(session('error'))
            <div class="bg-red-600 text-white px-4 py-3 text-center">
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="bg-green-600 text-white px-4 py-3 text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>
