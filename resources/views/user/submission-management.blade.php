<x-app-layout>
    @section('links')
        <li class="me-1">
            <a href="{{ route('home') }}" class="inline-block p-5 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">{{ __('Instructional Materials') }}</a>
        </li>
        <li class="me-1">
            <a href="{{ route('submission_management') }}" class="inline-block p-5 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500" aria-current="page">{{ __('Submissions') }}</a>
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

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- Add Campus Modal --}}
        <x-modal name="submit-modal" focusable>
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ __('Submit a Instructional Material') }}
                </h3>

                <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('admin.campus_management.store') }}">
                    @csrf
        
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Campus Name') }}</label>
                        <input type="text" name="campus_name" id="campus_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Enter the name for the campus') }}" required >
                        <x-input-error :messages="$errors->get('campus_name')" class="mt-1" />
                    </div>
        
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Location') }}</label>
                        <textarea rows="2" name="location" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter the location of the campus." required></textarea>
                        <x-input-error :messages="$errors->get('location')" class="mt-1" />
                    </div>

                    <div class="mt-5 pt-5 flex justify-between lg:justify-end">
                        <x-primary-button class="sm:w-44" type='submit'>
                            {{ __('Add Campus') }}
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

        <div class="bg-white p-6 rounded-lg">
            <div>
                <ul class="flex flex-wrap -mb-px font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                    <li role="presentation">
                        <button class="inline-block p-4 md:p-4 py-2 md:py-6 border-b-2 md:text-sm text-xs rounded-t-lg" id="submission-tab" data-tabs-target="#submission" type="button" role="tab" aria-controls="submission" aria-selected="false">{{ __('Submission') }}</button>
                    </li>
                    <li role="presentation">
                        <button class="inline-block p-4 md:p-4 py-2 md:py-6 border-b-2 md:text-sm text-xs rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="resubmission-tab" data-tabs-target="#resubmission" type="button" role="tab" aria-controls="resubmission" aria-selected="false">{{ __('Resubmission') }}</button>
                    </li>
                    <li role="presentation">
                        <button class="inline-block p-4 md:p-4 py-2 md:py-6 border-b-2 md:text-sm text-xs rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="approved-tab" data-tabs-target="#approved" type="button" role="tab" aria-controls="approved" aria-selected="false">{{ __('Approved') }}</button>
                    </li>
                    <li class="ml-auto flex items-center w-full mt-3 mb-3 sm:mb-0 lg:w-[400px] lg:mt-0" role="presentation">
                        <form action="{{ route('submission_management') }}" method="GET" id="search-form" class="w-full">   
                
                            <div class="relative w-full">
                                <input type="search" id="search-user" name="search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border-r-gray-50 border-r-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-r-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search for instructional materials by name" value="{{ request('search') }}">
                                <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-gray-800 rounded-r-lg border border-gray-800 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                    <span class="sr-only">Search</span>
                                </button>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
            <div class="border mb-3"></div>
            <div id="default-tab-content">
                {{-- * Submission Tab --}}
                <div class="hidden px-4 pb-4 rounded-lg" id="submission" role="tabpanel" aria-labelledby="submission-tab">
                    <div class="flex w-full flex-wrap items-center justify-between">
                        <form action="{{ route('submission_management') }}" method="GET" id="daterange-form">   
                            <div class="flex flex-wrap justify-between items-center">
                                <div date-rangepicker class="flex items-center">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <input name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start" onchange="submitSearch()">
                                    </div>
                                    <span class="mx-4 text-gray-500">to</span>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <input name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end" onchange="submitSearch()">
                                    </div>
                                    <button type="submit" class="p-2.5 text-sm font-medium h-full text-white bg-gray-800 rounded-r-lg border border-gray-800 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                                        {{ __('Go') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'submit-modal')" class="mt-3 sm:mt-0 w-full sm:w-auto px-3 py-2.5 text-sm font-medium inline-flex items-center bg-gray-800 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-800 dark:focus:ring-gray-800 justify-center text-white">
                            <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M.188 5H5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707c-.358.362-.617.81-.753 1.3C.148 5.011.166 5 .188 5ZM14 8a6 6 0 1 0 0 12 6 6 0 0 0 0-12Zm2 7h-1v1a1 1 0 0 1-2 0v-1h-1a1 1 0 0 1 0-2h1v-1a1 1 0 0 1 2 0v1h1a1 1 0 0 1 0 2Z"/>
                                <path d="M6 14a7.969 7.969 0 0 1 10-7.737V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H.188A.909.909 0 0 1 0 6.962V18a1.969 1.969 0 0 0 1.933 2h6.793A7.976 7.976 0 0 1 6 14Z"/>
                            </svg>
                            <span>
                                {{ __('Submit Material') }}
                            </span>
                        </button>
                    </div>
                    <div class="max-w-7xl mt-3 mx-auto space-y-6">
                        <div class="relative overflow-x-auto border sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Instructional Material') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Uploader') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Date Submitted') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Status') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="sr-only">{{ __('Actions') }}</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($campuses as $campus)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">{{ $campus->campus_name }}</div>
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $campus->location }}
                                            </td>
                                            <td class="px-6 py-4 capitalize">
                                                {{ $campus->created_at->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 capitalize">
                                                {{ $campus->updated_at->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('admin.campus_management.edit', $campus->id) }}" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                        <svg class="w-4 h-4 me-2 text-white transition duration-75 group-hover:text-blue-700 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                                            <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                                        </svg>
                                                        <span>{{ __('View') }}</span>
                                                    </a>
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
                        {{ $campuses->links() }}
                    </div>
                </div>
                
                {{-- * Resubmission Tab --}}
                <div class="hidden px-4 pb-4 rounded-lg" id="resubmission" role="tabpanel" aria-labelledby="resubmission-tab">
                    <div class="flex w-full flex-wrap items-center justify-between">
                        <form action="{{ route('submission_management') }}" method="GET" id="daterange-form">   
                            <div class="flex flex-wrap justify-between items-center">
                                <div date-rangepicker class="flex items-center">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <input name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start" onchange="submitSearch()">
                                    </div>
                                    <span class="mx-4 text-gray-500">to</span>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <input name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end" onchange="submitSearch()">
                                    </div>
                                    <button type="submit" class="p-2.5 text-sm font-medium h-full text-white bg-gray-800 rounded-r-lg border border-gray-800 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                                        {{ __('Go') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'submit-modal')" class="mt-3 sm:mt-0 w-full sm:w-auto px-3 py-2.5 text-sm font-medium inline-flex items-center bg-gray-800 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-800 dark:focus:ring-gray-800 justify-center text-white">
                            <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M.188 5H5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707c-.358.362-.617.81-.753 1.3C.148 5.011.166 5 .188 5ZM14 8a6 6 0 1 0 0 12 6 6 0 0 0 0-12Zm2 7h-1v1a1 1 0 0 1-2 0v-1h-1a1 1 0 0 1 0-2h1v-1a1 1 0 0 1 2 0v1h1a1 1 0 0 1 0 2Z"/>
                                <path d="M6 14a7.969 7.969 0 0 1 10-7.737V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H.188A.909.909 0 0 1 0 6.962V18a1.969 1.969 0 0 0 1.933 2h6.793A7.976 7.976 0 0 1 6 14Z"/>
                            </svg>
                            <span>
                                {{ __('Submit Material') }}
                            </span>
                        </button>
                    </div>
                    <div class="max-w-7xl mt-3 mx-auto space-y-6">
                        <div class="relative overflow-x-auto border sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Instructional Material') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Uploader') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Date Submitted') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Status') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="sr-only">{{ __('Actions') }}</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($campuses as $campus)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">{{ $campus->campus_name }}</div>
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $campus->location }}
                                            </td>
                                            <td class="px-6 py-4 capitalize">
                                                {{ $campus->created_at->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 capitalize">
                                                {{ $campus->updated_at->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('admin.campus_management.edit', $campus->id) }}" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                        <svg class="w-4 h-4 me-2 text-white transition duration-75 group-hover:text-blue-700 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                                            <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                                        </svg>
                                                        <span>{{ __('View') }}</span>
                                                    </a>
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
                        {{ $campuses->links() }}
                    </div>
                </div>
                
                {{-- * Approved Tab --}}
                <div class="hidden px-4 pb-4 rounded-lg" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                    <div class="flex w-full flex-wrap items-center justify-between">
                        <form action="{{ route('submission_management') }}" method="GET" id="daterange-form">   
                            <div class="flex flex-wrap justify-between items-center">
                                <div date-rangepicker class="flex items-center">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <input name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start" onchange="submitSearch()">
                                    </div>
                                    <span class="mx-4 text-gray-500">to</span>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <input name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end" onchange="submitSearch()">
                                    </div>
                                    <button type="submit" class="p-2.5 text-sm font-medium h-full text-white bg-gray-800 rounded-r-lg border border-gray-800 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                                        {{ __('Go') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'submit-modal')" class="mt-3 sm:mt-0 w-full sm:w-auto px-3 py-2.5 text-sm font-medium inline-flex items-center bg-gray-800 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-800 dark:focus:ring-gray-800 justify-center text-white">
                            <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M.188 5H5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707c-.358.362-.617.81-.753 1.3C.148 5.011.166 5 .188 5ZM14 8a6 6 0 1 0 0 12 6 6 0 0 0 0-12Zm2 7h-1v1a1 1 0 0 1-2 0v-1h-1a1 1 0 0 1 0-2h1v-1a1 1 0 0 1 2 0v1h1a1 1 0 0 1 0 2Z"/>
                                <path d="M6 14a7.969 7.969 0 0 1 10-7.737V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H.188A.909.909 0 0 1 0 6.962V18a1.969 1.969 0 0 0 1.933 2h6.793A7.976 7.976 0 0 1 6 14Z"/>
                            </svg>
                            <span>
                                {{ __('Submit Material') }}
                            </span>
                        </button>
                    </div>
                    <div class="max-w-7xl mt-3 mx-auto space-y-6">
                        <div class="relative overflow-x-auto border sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Instructional Material') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Uploader') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Date Submitted') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Status') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="sr-only">{{ __('Actions') }}</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($campuses as $campus)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">{{ $campus->campus_name }}</div>
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $campus->location }}
                                            </td>
                                            <td class="px-6 py-4 capitalize">
                                                {{ $campus->created_at->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 capitalize">
                                                {{ $campus->updated_at->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('admin.campus_management.edit', $campus->id) }}" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                        <svg class="w-4 h-4 me-2 text-white transition duration-75 group-hover:text-blue-700 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                                            <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                                        </svg>
                                                        <span>{{ __('View') }}</span>
                                                    </a>
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
                        {{ $campuses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @section('scripts')
        <script src="{{ asset('js/search-filter.js') }}"></script>
        <script src="{{ asset('js/functions.js') }}"></script>
    @endsection
</x-app-layout>