<x-app-layout>
    <x-slot name="header">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li>
                    <div class="flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="text-xs lg:text-sm font-medium text-gray-500 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{ __('Dashboard') }}</a></a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                    <svg class="w-2 lg:w-3 h-2 lg:h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <a href="{{ route('admin.campus_management') }}" class="ml-1 text-xs lg:text-sm font-medium text-gray-500 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{ __('Campus Management') }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                    <svg class="w-2 lg:w-3 h-2 lg:h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ml-1 font-semibold text-sm lg:text-lg text-gray-700 dark:text-gray-400">{{ __('Edit') }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    <div class="p-8 bg-white rounded-lg mt-6">
        <h1 class="text-md font-bold leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white">
            {{ __('Campus Information') }}
        </h1>

        <form action="{{ route('admin.campus_management.update') }}" method="POST" class="space-y-6"> 
            @csrf
            @method('PATCH')

            <input type="hidden" name="campus_id" value="{{ $campus->id }}">

            <div class="w-full lg:w-3/4">
                <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Campus Name') }}</label>
                <input type="text" name="campus_name" id="campus_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Enter the name for the campus') }}" required value="{{ old('campus_name', $campus->campus_name) }}">
                <x-input-error :messages="$errors->get('campus_name')" class="mt-1" />
            </div>

            <div class="w-full lg:w-3/4">
                <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Location') }}</label>
                <textarea rows="6" name="location" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter the location of the campus.">{{ old('location', $campus->location) }}</textarea>
            </div>

            <x-input-error :messages="$errors->get('campus')" class="mt-1" />
    
            <div class="flex items-center gap-4">
                <x-primary-button class="sm:w-44">{{ __('Save') }}</x-primary-button>
                <x-secondary-button class="sm:w-44">
                    <a href="{{ route('admin.campus_management') }}">
                        {{ __('Cancel') }}
                    </a>
                </x-secondary-button>
            </div>
        </form>
    </div>
</x-app-layout>