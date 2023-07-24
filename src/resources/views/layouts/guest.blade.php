<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/x-guest.css') }}" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        @include('layouts.header')
            <div class="content-main  bg-gray-100 ">
                    <div class="w-full flex flex-col sm:justify-center items-center pt-24">
                    @yield('Add_item')
                    <div class="w-full sm:max-w-md mt-0 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-b-lg">
                        {{ $slot }}
                    </div>
                </div>
            </div>
    </body>
</html>
