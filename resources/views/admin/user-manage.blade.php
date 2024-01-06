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
                    <a href="{{ route('admin.user_management') }}" class="ml-1 text-xs lg:text-sm font-medium text-gray-500 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{ __('User Management') }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                    <svg class="w-2 lg:w-3 h-2 lg:h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ml-1 font-semibold text-sm lg:text-lg text-gray-700 dark:text-gray-400">{{ __('Account') }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    <div class="p-8 bg-white rounded-lg mb-4">
        <h1 class="text-md font-bold leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white">
            {{ __('Account Information') }}
        </h1>
    
        <div class="mt-3 space-y-6">
            <div class="sm:col-span-4 flex justify-between">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ $user->firstname . ' ' . $user->lastname }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ $user->email }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ $user->universityRole->university_role . ' at ' . $user->campus->campus_name . ' Campus' }}</div>
                </div>
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ 'Joined at ' . \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}</div>
                    <span class="text-sm text-center font-medium mr-2 px-2.5 py-1 rounded 
                        @if ($user->role->id == 1 || $user->role->id == 2)
                            bg-blue-100 text-blue-800  dark:bg-blue-900 dark:text-blue-300
                        @elseif ($user->role->id == 3)
                            bg-violet-100 text-violet-800 dark:bg-violet-700 dark:text-violet-300
                        @else
                            bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-300
                        @endif">
                        {{ $user->role->role_name }}
                    </span>
                    {{-- <div class="font-medium text-sm text-gray-500">{{ $user->role->role_name }}</div> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-100 border border-2 border-green-500 dark:bg-gray-800 dark:text-green-400" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium">
                {{ session('success') }}
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @elseif (session('error'))
        <div id="alert-3" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-100 border border-2 border-red-500 dark:bg-gray-800 dark:text-red-400" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium">
                {{ session('error') }}
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
    {{-- Alert End --}}

    <div class="p-8 bg-white rounded-lg mt-6">
        <h1 class="text-md font-bold leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white">
            {{ __('System Role') }}
        </h1>
        <p class="text-sm text-start text-gray-500 dark:text-gray-300" id="file_input_help" style="margin-top: 12px !important;"><span class="text-sm font-bold">{{ __('Note: ') }}</span>{{ __('Choose the appropriate system role for this account.') }}</p>

        <form action="{{ route('user.update') }}" method="POST" class="space-y-6"> 
            @csrf
            @method('patch')

            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <div class="w-full lg:w-3/4">
                <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('System Role') }}</label>
                <div class="flex items-start">
                    <select name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" @if($role->id == $user->role_id) selected @endif>{{ $role->role_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <h1 class="text-md pt-4 font-bold leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white">
                {{ __('University Information') }} 
            </h1>
            <p class="text-sm text-start text-gray-500 dark:text-gray-300" id="file_input_help" style="margin-top: 12px !important;"><span class="text-sm font-bold">{{ __('Note: ') }}</span>{{ __('Choose the relevant university information for this account.') }}</p>

            <div class="w-full lg:w-3/4">
                <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('University Role') }}</label>
                <div class="flex items-start">
                    <select name="university_role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" required>
                        @foreach($universityRoles as $universityRole)
                            <option value="{{ $universityRole->id }}" @if($universityRole->id == $user->univ_role_id) selected @endif>{{ $universityRole->university_role }}</option>
                        @endforeach
                    </select>
                </div>
                <x-input-error :messages="$errors->get('university_role')" class="mt-1" />
            </div>

            <div class="w-full lg:w-3/4">
                <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Campus') }}</label>
                <div class="flex items-start">
                    <select name="campus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" required>
                        @foreach($campuses as $campus)
                            <option value="{{ $campus->id }}" @if($campus->id == $user->campus_id) selected @endif>{{ $campus->campus_name }}</option>
                        @endforeach
                    </select>
                </div>
                <x-input-error :messages="$errors->get('campus')" class="mt-1" />
            </div>
    
            <div class="flex items-center gap-4">
                <x-primary-button class="sm:w-44">{{ __('Save') }}</x-primary-button>
                <x-secondary-button class="sm:w-44">
                    <a href="{{ route('admin.user_management') }}">
                        {{ __('Cancel') }}
                    </a>
                </x-secondary-button>
            </div>
        </form>
    </div>

    <div class="p-8 bg-white rounded-lg mt-6">
        <h1 class="text-md font-bold leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white">
            {{ __('Delete Account') }}
        </h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once this account is deleted, all of its resources and data will be permanently deleted.') }}
        </p>
    
        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="sm:w-44 mt-6"
        >{{ __('Delete Account') }}</x-danger-button>

        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" :maxWidth="'lg'" focusable>
            <form method="post" action="{{ route('user.destroy') }}" class="p-6">
                @csrf
                @method('DELETE')

                <input type="hidden" name="user_id" value="{{ $user->id }}">
                
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to delete this account?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Once the account is deleted, all of its resources and data will be permanently deleted.') }}
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')" class="sm:w-44">
                        {{ __('Cancel') }}
                    </x-secondary-button>
                    
                    <x-danger-button class="ms-3 sm:w-44">
                        {{ __('Delete Account') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>