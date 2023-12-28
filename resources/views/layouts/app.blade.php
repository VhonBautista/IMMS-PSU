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
    <body class="font-sans antialiased">
        @yield('top-scripts')
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 test-bg">
            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                <!-- Admin user -->
                @include('layouts.sidebar')

                <div class="flex flex-col min-h-screen sm:ml-72">
                    <div class="flex-grow p-4">
                        <div class="pt-2 rounded-lg mt-12">
                            @if (isset($header))
                                <header class="py-5 px-4 mb-5 sm:px-6 lg:px-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                                    <div class="">
                                        {{ $header }}
                                    </div>
                                </header>
                            @endif
                            {{ $slot }}
                        </div>
                    </div>
                    
                    <footer class="bg-gray-800 text-white text-center">
                        @include('layouts.footer')
                    </footer>
                </div>
            @else
                <!-- Normal user -->
                @include('layouts.navigation')

                <div class="flex flex-col min-h-screen">
                    <div class="flex-grow p-4">
                        <div class=" sm:px-12 lg:px-8">
                            {{ $slot }}
                        </div>
                    </div>
                    
                    <footer class="bg-gray-800 text-white text-center">
                        @include('layouts.footer')
                    </footer>
                </div>
            @endif
        </div>
        
        <script src="{{ asset('js/jquery.js')}}"></script>
        <script src="{{ asset('js/mark-read.js')}}"></script>
        @yield('scripts')
    </body>
</html>
