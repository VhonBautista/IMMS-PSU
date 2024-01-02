<x-app-layout>
    <x-slot name="header">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li>
                    <div class="flex items-center">
                        <a href="{{ route('admin.dashboard') }}"
                            class="text-xs lg:text-sm font-medium text-gray-500 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{ __('Dashboard') }}</a></a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-2 lg:w-3 h-2 lg:h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{ route('admin.college') }}"
                            class="ml-1 text-xs lg:text-sm font-medium text-gray-500 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{ __('College Management') }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-2 lg:w-3 h-2 lg:h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span
                            class="ml-1 font-semibold text-sm lg:text-lg text-gray-700 dark:text-gray-400">{{ __('Edit') }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    <div class="container mx-auto mt-8">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6">Edit College</h2>

            <form action="{{ route('college.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" value="{{ $college->id }}">
                {{-- college name --}}
                <div class="w-full lg:full">
                    <label
                        class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('College Name') }}</label>
                    <input type="text" name="college_name" id="college_name"
                        value="{{ old('college_name', $college->college_name) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Enter the name for the College') }}" required>
                </div>

                {{-- description --}}
                <div class="w-full lg:full">
                    <label
                        class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Description') }}</label>
                    <textarea rows="2" name="description"
                        class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Description">{{ old('description', $college->description) }}</textarea>
                </div>

                {{-- campus ID --}}
                <div class="w-full lg:w-full">
                    <label
                        class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Campus') }}</label>
                    <div class="flex items-start w-full">
                        <select name="campus_id"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto"
                            required>
                            <option value="" disabled selected>Choose College ID</option>
                            @foreach ($campuses as $campus)
                                <option value="{{ $campus->id }}"
                                    {{ old('campus_id', $college->campus_id) == $campus->id ? 'selected' : '' }}>
                                    {{ $campus->id . ' - ' . $campus->campus_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-5 pt-5 flex justify-between lg:justify-start">
                    <x-primary-button class="sm:w-44">{{ __('Save') }}</x-primary-button>

                    <x-secondary-button class="ms-3 sm:w-44">
                        <a href="{{ route('admin.college') }}">
                            {{ __('Cancel') }}
                        </a>
                    </x-secondary-button>
                </div>
            </form>

        </div>
    </div>


</x-app-layout>
