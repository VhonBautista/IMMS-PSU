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
                        <span class="ml-1 font-semibold text-sm lg:text-lg text-gray-700 dark:text-gray-400">{{ __('Notifications') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </x-slot>
    
    <div class="bg-white p-6 rounded-lg">
        <div class="max-h-[500px] overflow-y-auto">
            <div class="mb-4">
                <h1 class="text-md font-bold mb-3 leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white">
                    {{ __('Unread Notifications') }}
                </h1>
                @forelse($unreadNotifications as $notification)
                    <a href="{{ route($notification->data['route']) }}" onclick="event.preventDefault(); markNotificationAsReadAndRedirect(this, '{{ route('mark-as-read', ['id' => $notification->id]) }}')" class="flex justify-center md:justify-start items-center w-full px-0 md:px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700"> 
                        {{-- Icons --}}
                        @switch($notification->data['action'])
                            @case('added')
                            @case('created')
                            @case('registered')
                                <svg class="w-7 h-7 hidden md:block text-blue-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                @break

                            @case('deleted')
                            @case('rejected')
                            @case('removed')
                                <svg class="w-7 h-7 hidden md:block text-red-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                @break

                            @case('approved')
                                <svg class="w-7 h-7 hidden md:block text-green-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 10 2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                @break

                            @default
                                <svg class="w-7 h-7 hidden md:block text-violet-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9h2v5m-2 0h4M9.408 5.5h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                        @endswitch

                        {{-- Details --}}
                        <div scope="row" class="px-0 md:px-4 w-full font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="font-black text-sm text-gray-800 dark:text-gray-200 capitalize">
                                {{ $notification->data['title'] }}
                            </div>
                            <div class="font-black text-xs capitalize text-gray-500 flex justify-between items-center">
                                <span class="max-w-[200px] md:max-w-[400px] overflow-hidden overflow-ellipsis">
                                    {{ $notification->data['description'] }}
                                </span>
                                <span class="text-xs text-gray-500 font-black lowercase">
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>                                    
                    </a>
                @empty
                <div class="flex justify-center items-center text-sm text-gray-500 py-6">
                    {{ __('No unread notifications.') }}
                </div>
                @endforelse
            </div>
        
            <div>
                <h1 class="text-md font-bold mb-3 leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white">
                    {{ __('Read Notifications') }}
                </h1>
                @forelse($readNotifications as $notification)
                    <a href="{{ route($notification->data['route']) }}" onclick="event.preventDefault(); markNotificationAsReadAndRedirect(this, '{{ route('mark-as-read', ['id' => $notification->id]) }}')" class="flex justify-center md:justify-start items-center w-full px-0 md:px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700"> 
                        {{-- Icons --}}
                        @switch($notification->data['action'])
                            @case('added')
                            @case('created')
                            @case('registered')
                                <svg class="w-7 h-7 hidden md:block text-blue-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                @break

                            @case('deleted')
                            @case('rejected')
                            @case('removed')
                                <svg class="w-7 h-7 hidden md:block text-red-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                @break

                            @case('approved')
                                <svg class="w-7 h-7 hidden md:block text-green-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 10 2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                @break

                            @default
                                <svg class="w-7 h-7 hidden md:block text-violet-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9h2v5m-2 0h4M9.408 5.5h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                        @endswitch

                        {{-- Details --}}
                        <div scope="row" class="px-0 md:px-4 w-full font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">
                                {{ $notification->data['title'] }}
                            </div>
                            <div class="font-normal text-xs capitalize text-gray-500 flex justify-between items-center">
                                <span class="max-w-[200px] md:max-w-[400px] overflow-hidden overflow-ellipsis">
                                    {{ $notification->data['description'] }}
                                </span>
                                <span class="text-xs text-gray-500 font-normal lowercase">
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>                                    
                    </a>
                @empty
                <div class="flex justify-center items-center text-sm text-gray-500 py-6">
                    {{ __('No read notifications.') }}
                </div>
                @endforelse
            </div>
        </div>
        <a href="" onclick="markAllNotificationsAsRead('{{ route('mark-all-as-read') }}')" class="block pt-6 text-start text-sm text-blue-700 rounded-lg">
            {{ __('Mark All as Read') }}
        </a>
    </div>
    
    @section('scripts')
        <script src="{{ asset('js/search-filter.js') }}"></script>
    @endsection
</x-app-layout>