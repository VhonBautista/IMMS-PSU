<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Campus') }}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto mt-8">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-md shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">{{ __('Edit Campus') }}</h2>

            <form action="{{ route('admin.campuses-management.update', $campus->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="campus_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Campus Name</label>
                    <input type="text" name="campus_name" id="campus_name" value="{{ $campus->campus_name }}" class="mt-1 p-2 w-full border rounded-md">
                </div>

                <div class="mb-4">
                    <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                    <input type="text" name="location" id="location" value="{{ $campus->location }}" class="mt-1 p-2 w-full border rounded-md">
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                        {{ __('Update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>


</x-app-layout>