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
                        <span class="ml-1 font-semibold text-sm lg:text-lg text-gray-700 dark:text-gray-400">{{ __('College Management') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            
            <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-campus-modal')" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-gray-800 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                <svg class="w-4 h-4 text-white lg:me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.546.5a9.5 9.5 0 1 0 9.5 9.5 9.51 9.51 0 0 0-9.5-9.5ZM13.788 11h-3.242v3.242a1 1 0 1 1-2 0V11H5.304a1 1 0 0 1 0-2h3.242V5.758a1 1 0 0 1 2 0V9h3.242a1 1 0 1 1 0 2Z"/>
                </svg>
                <span class="hidden lg:block">
                    {{ __('Add college') }}
                </span>
            </button>
        </div>
    </x-slot>

    {{-- Add College Modal --}}
    <x-modal name="add-campus-modal" focusable>
        <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                {{ __('Add New College') }}
            </h3>

            <form class="space-y-4 md:space-y-6 w-full" method="POST" action="{{ route('admin.college_management.store') }}">
                @csrf
               
                <div class="w-full">
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('College Name') }}</label>
                    <input type="text" name="college_name" id="college_name" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Enter the name for the College') }}" required >
                    <x-input-error :messages="$errors->get('college_name')" class="mt-1" />
                </div>
                
                <div class="w-full">
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Campus') }}</label>
                    <div class="flex items-start w-full">
                        <select name="campus_id" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" required>
                            <option value="" disabled selected>Choose Campus</option>
                            @foreach($campuses as $campus)
                                <option value="{{ $campus->id }}">{{ $campus->campus_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('campus_id')" class="mt-1" />
    
                <div class="w-full">
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Description (Optional)') }}</label>
                    <textarea rows="4" name="description" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter the description for the college"></textarea>
                </div>

                <div class="mt-5 pt-5 flex justify-between lg:justify-end">
                    <x-primary-button class="sm:w-44" type='submit'>
                        {{ __('Add College') }}
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
        <form action="{{ route('admin.college_management') }}" method="GET" id="search-form" class="flex flex-col justify-center md:flex-row md:justify-between">
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
            </div>             

            <div class="relative w-full md:w-3/4">
                <input type="search" id="search-user" name="search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border-r-gray-50 border-r-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-r-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search for colleges by college name" value="{{ request('search') }}">
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
                                {{ __('Department Name') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Campus') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Date Added') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Last Updated') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">{{ __('Actions') }}</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($colleges as $college)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">{{ $college->college_name }}</div>
                                </th>
                                <td class="px-6 py-4 text-xs">
                                    {{ $college->campus->campus_name}}
                                </td>
                                <td class="px-6 py-4 text-xs capitalize">
                                    {{ $college->created_at->format('M d, Y h:i A') }}
                                </td>
                                <td class="px-6 py-4 text-xs capitalize">
                                    {{ $college->updated_at->format('M d, Y h:i A') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.college_management.edit', $college->id) }}" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            <svg class="w-4 h-4 me-2 text-white transition duration-75 group-hover:text-blue-700 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                                <path d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z"/>
                                                <path d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z"/>
                                            </svg>
                                            <span>{{ __('Edit') }}</span>
                                        </a>
                                        <button type="button" onclick="setDeleteFormAction('college-id-input', {{ $college->id }})" x-data="" x-on:click.prevent="$dispatch('open-modal', 'delete-college-modal')" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-red-600 rounded-lg hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-500 dark:bg-red-600 dark:hover:bg-red-800 dark:focus:ring-red-800">
                                            <svg class="w-4 h-4 text-white me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                                <path d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z"/>
                                            </svg>
                                            <span>
                                                {{ __('Delete') }}
                                            </span>
                                        </button>
                                    </div>
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
            {{ $colleges->links() }}
        </div>
    </div>

    {{-- Delete College Modal --}}
    <x-modal name="delete-college-modal" :maxWidth="'md'" focusable>
        <div class="p-6">
            <form class="space-y-4 md:space-y-6" id="delete-college-form" method="POST" action="{{ route('admin.college_management.destroy') }}">
                @csrf
                @method('DELETE')
    
                <input type="hidden" name="college_id" id="college-id-input" value="">

                <div class="text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ __('Delete College') }}
                    </h3>
                    <h3 class="mb-5 text-md font-medium text-gray-500 dark:text-gray-400">{{ __('Confirm deletion of this college? This action is irreversible.') }}</h3>
                </div>

                <div class="mt-5 pt-5 flex justify-between lg:justify-center">
                    <x-secondary-button x-on:click="$dispatch('close')" class="sm:w-44">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3 sm:w-44">
                        {{ __('Delete') }}
                    </x-danger-button>
                </div>
            </form>
        </div>
    </x-modal>
    {{-- Modal End --}}

    @section('scripts')
        <script src="{{ asset('js/search-filter.js') }}"></script>
        <script src="{{ asset('js/functions.js') }}"></script>
    @endsection
</x-app-layout>