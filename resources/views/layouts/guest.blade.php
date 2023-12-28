<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('PSU IMMS') }}</title>

        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center py-6 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="" class="flex w-full justify-center items-center">
                    <img class="w-12 h-12 mr-2" src="{{ asset('assets/system/Pangasinan_State_University_logo.png') }}" alt="logo">
                    <div>
                        <h1 class="text-2xl font-bold leading-tight tracking-widest text-gray-900 dark:text-white">
                            {{ __('PSU I.M.M.S.') }}
                        </h1>
                        <h1 class="text-xs font-bold leading-tight tracking-tight text-gray-900 dark:text-white">
                            {{ __('Instructional Material Management System') }}
                        </h1>
                    </div>
                </a>
            </div>

            {{ $slot }}
        </div>
    </body>
</html>
