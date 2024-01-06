<x-app-layout>
    @if ($user->role_id  == 4)
        @section('links')
            <li class="me-1">
                <a href="{{ route('home') }}" class="inline-block p-5 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">{{ __('Instructional Materials') }}</a>
            </li>
            <li class="me-1">
                <a href="{{ route('submission_management') }}" class="inline-block p-5 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">{{ __('Submissions') }}</a>
            </li>
        @endsection   

        @section('burger_links')
            <x-responsive-nav-link :href="route('home')">
                {{ __('Instructional Materials') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('submission_management')">
                {{ __('Submissions') }}
            </x-responsive-nav-link>
        @endsection   
    @endif

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li>
                        <div class="flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="text-xs lg:text-sm font-medium text-gray-500 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{ __('Dashboard') }}</a></a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                        <svg class="w-2 lg:w-3 h-2 lg:h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ml-1 font-semibold text-sm lg:text-lg text-gray-700 dark:text-gray-400">{{ __('Profile') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.view-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>
        
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
