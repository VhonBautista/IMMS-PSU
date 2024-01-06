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
                        <span class="ml-1 font-semibold text-sm lg:text-lg text-gray-700 dark:text-gray-400">{{ __('System Logs') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </x-slot>
    
    <div class="bg-white p-6 rounded-lg">
        <form action="{{ route('admin.system_log') }}" method="GET" id="search-form" class="flex flex-col justify-center md:flex-row md:justify-between">
            <label for="search-user" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    
            <div class="flex w-full flex-wrap">
                <div class="w-full lg:w-auto px-0 lg:px-1 pb-3 lg:pb-0">
                    <select name="action" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" onchange="submitSearch()">
                        <option value="" @if(!request('action')) selected @endif>Select Action</option>
                        <option value="added" @if(request('action') == 'added' ) selected @endif>Added</option>
                        <option value="approved" @if(request('action') == 'approved' ) selected @endif>{{ __('Approved') }}</option>
                        <option value="rejected" @if(request('action') == 'rejected' ) selected @endif>{{ __('Rejected') }}</option>
                        <option value="created" @if(request('action') == 'created' ) selected @endif>{{ __('Created') }}</option>
                        <option value="updated" @if(request('action') == 'updated' ) selected @endif>{{ __('Updated') }}</option>
                        <option value="deleted" @if(request('action') == 'deleted' ) selected @endif>{{ __('Deleted') }}</option>
                        <option value="removed" @if(request('action') == 'removed' ) selected @endif>{{ __('Removed') }}</option>
                        <option value="registered" @if(request('action') == 'registered' ) selected @endif>{{ __('Registered') }}</option>
                        <option value="submitted" @if(request('action') == 'submitted' ) selected @endif>{{ __('Submitted') }}</option>
                    </select>
                </div>
            </div>

            <div class="relative w-full md:w-3/4">
                <input type="search" id="search-user" name="search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border-r-gray-50 border-r-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-r-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search for logs by user or description" value="{{ request('search') }}">
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
                                {{ __('Description') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Action') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Logged Date') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">
                                        {{ $log->user->firstname . ' ' . $log->user->lastname . ' ' . $log->user->middlename }}
                                    </div>
                                </th>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">
                                        <a data-tooltip-target="tooltip-view-{{ $log->id }}" href="{{ $log->area !== 'none' ? route($log->area) : $log->area }}" class="text-blue-600 dark:text-blue-500 hover:underline">
                                            {{ $log->title }}
                                        </a>

                                        <div id="tooltip-view-{{ $log->id }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                            View
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>
                                    </div>
                                    <div class="font-medium text-xs capitalize text-gray-500">
                                        {{ $log->description }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 capitalize">
                                    <span class="block text-sm text-center font-medium mr-2 px-2.5 py-1 rounded 
                                        @if ($log->action == 'added' || $log->action == 'submitted' || $log->action == 'created' || $log->action == 'registered')
                                            bg-blue-100 text-blue-800  dark:bg-blue-900 dark:text-blue-300
                                        @elseif ($log->action == 'deleted' || $log->action == 'rejected' || $log->action == 'removed')
                                            bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-300
                                        @elseif ($log->action == 'approved')
                                            bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-300
                                        @else
                                            bg-violet-100 text-violet-800 dark:bg-violet-700 dark:text-violet-300
                                        @endif
                                    ">
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 capitalize">
                                    {{ $log->created_at->format('M d, Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td colspan="7" class="px-6 py-4 text-center">
                                    <div class="p-4 text-sm">
                                        {{ __('There are no logs') }}
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $logs->links() }}
        </div>
    </div>
    
    @section('scripts')
        <script src="{{ asset('js/search-filter.js') }}"></script>
    @endsection
</x-app-layout>