<x-app-layout>
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
                        <span class="ml-1 font-semibold text-sm lg:text-lg text-gray-700 dark:text-gray-400">{{ __('User Management') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            
            <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-user-account')" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-gray-800 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                <svg class="w-4 h-4 text-white lg:me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                    <path d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-2V5a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V9h2a1 1 0 1 0 0-2Z"/>
                </svg>
                <span class="hidden lg:block">
                    {{ __('Create Account') }}
                </span>
            </button>
        </div>
    </x-slot>

    {{-- Create Account Modal --}}
    <x-modal name="add-user-account" focusable>
        <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                {{ __('Create New Account') }}
            </h3>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Create a new user account by entering relevant information for this account.') }}
            </p>

            <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('user.create_account') }}">
                @csrf
    
                <h1 class="text-md font-bold leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white">
                    {{ __('System Role') }}
                </h1>
                <p class="text-sm text-start text-gray-500 dark:text-gray-300" id="file_input_help" style="margin-top: 12px !important;"><span class="text-sm font-bold">{{ __('Note: ') }}</span>{{ __('Choose the appropriate system role for this account.') }}</p>
    
                <div class="flex items-start">
                    <select name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" required>
                        <option value="" selected>Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                        @endforeach
                    </select>
                </div>
    
                <h1 class="text-md font-bold leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white mt-0">
                    {{ __('Account Details') }}
                </h1>
    
                <div>
                    <div class="grid grid-cols-6 gap-2">
                        <div class="col-span-2">
                            <input type="text" name="firstname" id="firstname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Given Name') }}" required autofocus value="{{ old('firstname') }}">
                        </div>
                        <div class="col-span-2">
                            <input type="text" name="lastname" id="lastname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Family Name') }}" required value="{{ old('lastname') }}">
                        </div>
                        <div class="col-span-2">
                            <input type="text" name="middlename" id="middlename" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Middle Initial') }}" value="{{ old('middlename') }}">
                        </div>
                    </div>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">{{ __('Middle initial is not required.') }}</p>
                    <x-input-error :messages="$errors->get('lastname')" class="mt-1" />
                    <x-input-error :messages="$errors->get('firstname')" class="mt-1" />
                </div>
    
                <div>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Enter email address') }}" required value="{{ old('email') }}">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">{{ __('Email must be a valid email address.') }}</p>
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>
    
                <div>
                    <input type="text" name="password" id="password" placeholder="{{ __('Enter your password') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="temporary123">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">{{ __('This is a temporary password, automatically generated. Feel free to assign a personalized password.') }}</p>
                </div>
        
                <div class="flex items-start ms-1" style="margin-top: 6px !important;">
                    <div class="flex items-center h-5">
                        <input id="show_password" aria-describedby="show_password" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" checked>
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="show_password" class="text-gray-500 dark:text-gray-300">{{ __('Show passwords') }}</label>
                    </div>
                </div>        
                
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    
                <h1 class="text-md font-bold leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white">
                    {{ __('University Details') }}
                </h1>
                <p class="text-sm text-start text-gray-500 dark:text-gray-300" id="file_input_help" style="margin-top: 12px !important;"><span class="text-sm font-bold">{{ __('Note: ') }}</span>{{ __('Choose the relevant university information for this account.') }}</p>
    
                <div class="flex items-start">
                    <select name="university_role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" required>
                        <option value="" selected>Select University Role</option>
                        @foreach($universityRoles as $universityRole)
                            <option value="{{ $universityRole->id }}">{{ $universityRole->university_role }}</option>
                        @endforeach
                    </select>
                </div>
    
                <x-input-error :messages="$errors->get('university_role')" class="mt-1" />      
                
                <div class="flex items-start">
                    <select name="campus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" required>
                        <option value="" selected>Select Campus</option>
                        @foreach($campuses as $campus)
                            <option value="{{ $campus->id }}">{{ $campus->campus_name }}</option>
                        @endforeach
                    </select>
                </div>
    
                <x-input-error :messages="$errors->get('campus')" class="mt-1" />

                <div class="mt-5 pt-5 flex justify-between lg:justify-end">
                    <x-primary-button class="sm:w-44">
                        {{ __('Create Account') }}
                    </x-primary-button>
    
                    <x-secondary-button x-on:click="$dispatch('close')" class="ms-3 sm:w-44">
                        {{ __('Cancel') }}
                    </x-secondary-button>
                </div>
            </form>
        </div>
    </x-modal>
    {{-- Modal End --}}
    
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
    @endif
    {{-- Alert End --}}

    <div class="bg-white p-6 rounded-lg ">
        <form action="{{ route('admin.user_management') }}" method="GET" id="search-form" class="flex flex-col justify-center md:flex-row md:justify-between">
            <label for="search-user" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    
            <div class="flex w-full flex-wrap">
                <div class="w-full lg:w-auto px-0 lg:px-1 pb-3 lg:pb-0">
                    <select name="campus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" onchange="submitSearch()">
                      <option value="" @if(!request('campus')) selected @endif>Select Campus</option>
                      @foreach($campuses as $campus)
                        <option value="{{ $campus->id }}" @if(request('campus') == $campus->id) selected @endif>{{ $campus->campus_name }}</option>
                      @endforeach
                    </select>
                </div>

                <div class="w-full lg:w-auto px-0 lg:px-1 pb-3 lg:pb-0">
                    <select name="university_role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" onchange="submitSearch()">
                        <option value="" @if(!request('university_role')) selected @endif>Select University Role</option>
                        @foreach($universityRoles as $role)
                            <option value="{{ $role->id }}" @if(request('university_role') == $role->id) selected @endif>{{ $role->university_role }}</option>
                        @endforeach
                    </select>
                </div>
            </div>                   
    
            <div class="relative w-full md:w-3/4">
                <input type="search" id="search-user" name="search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border-r-gray-50 border-r-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-r-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search for users by name or email" value="{{ request('search') }}">
                <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-gray-800 rounded-r-lg border border-gray-800 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </form>
    
        <div class="max-w-7xl mt-3 mx-auto space-y-6">
            <div class="relative overflow-x-auto border sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{ __('User') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('User Type') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('University Role') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Campus') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Date Joined') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">{{ __('Actions') }}</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">{{ $user->lastname . ', ' . $user->firstname . ' ' . $user->middlename }}</div>
                                    <div class="font-medium text-xs text-gray-500">{{ $user->email }}</div>
                                </th>
                                <td class="px-6 py-4">
                                    <span class="block text-sm text-center font-medium mr-2 px-2.5 py-1 rounded 
                                        @if ($user->role->id == 1 || $user->role->id == 2)
                                            bg-blue-100 text-blue-800  dark:bg-blue-900 dark:text-blue-300
                                        @elseif ($user->role->id == 3)
                                            bg-violet-100 text-violet-800 dark:bg-violet-700 dark:text-violet-300
                                        @else
                                            bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-300
                                        @endif
                                    ">
                                        {{ $user->role->role_name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $user->universityRole->university_role }}
                                </td>
                                <td class="px-6 py-4 capitalize">
                                    {{ $user->campus->campus_name }}
                                </td>
                                <td class="px-6 py-4 capitalize">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('user.manage', $user->id) }}" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg class="w-4 h-4 me-2 text-white transition duration-75 group-hover:text-blue-700 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M18 7.5h-.423l-.452-1.09.3-.3a1.5 1.5 0 0 0 0-2.121L16.01 2.575a1.5 1.5 0 0 0-2.121 0l-.3.3-1.089-.452V2A1.5 1.5 0 0 0 11 .5H9A1.5 1.5 0 0 0 7.5 2v.423l-1.09.452-.3-.3a1.5 1.5 0 0 0-2.121 0L2.576 3.99a1.5 1.5 0 0 0 0 2.121l.3.3L2.423 7.5H2A1.5 1.5 0 0 0 .5 9v2A1.5 1.5 0 0 0 2 12.5h.423l.452 1.09-.3.3a1.5 1.5 0 0 0 0 2.121l1.415 1.413a1.5 1.5 0 0 0 2.121 0l.3-.3 1.09.452V18A1.5 1.5 0 0 0 9 19.5h2a1.5 1.5 0 0 0 1.5-1.5v-.423l1.09-.452.3.3a1.5 1.5 0 0 0 2.121 0l1.415-1.414a1.5 1.5 0 0 0 0-2.121l-.3-.3.452-1.09H18a1.5 1.5 0 0 0 1.5-1.5V9A1.5 1.5 0 0 0 18 7.5Zm-8 6a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7Z"/>
                                        </svg>
                                        <span>{{ __('Manage') }}</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td colspan="7" class="px-6 py-4 text-center">
                                    <div class="p-4 text-sm">
                                        {{ __('There are no records') }}
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        </div>
    </div>

    @section('scripts')
        <script src="{{ asset('js/search-filter.js') }}"></script>
        <script src="{{ asset('js/show-password.js') }}"></script>
    @endsection
</x-app-layout>