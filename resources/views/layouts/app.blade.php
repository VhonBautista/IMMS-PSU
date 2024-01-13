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
        <!-- Add this to your HTML head section -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.0/viewer.min.css" integrity="sha384-tPq1S1lVD1HF1IdLpZZ49PBfWwMHgKd3dtShyyLJd5i+Y/dKbPQbr7u3dI5I2ymo" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.0/viewer.min.js" integrity="sha384-kOj+S0LBr+MjA+qmN8L7/OiMdF/v9AzuXzM+X8e+HtHysCdUOq+C02AJfOKcvq5Y" crossorigin="anonymous"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        @yield('top-scripts')
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 test-bg">
            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
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
                        <div class="pt-2 rounded-lg">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                    </div>
                    
                    <footer class="bg-gray-800 text-white text-center">
                        @include('layouts.footer')
                    </footer>
                </div>
            @endif
        </div>
        
        <script src="{{ asset('js/jquery.js')}}"></script>
        <script src="{{ asset('js/mark-read.js')}}"></script>
        <script src="{{ asset('js/session-storage.js')}}"></script>
        @yield('scripts')
        @yield('javascripts')
    </body>
</html>