<x-app-layout>
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
                            <div class="font-bold text-sm text-gray-800 dark:text-gray-200 capitalize">
                                {{ $notification->data['title'] }}
                            </div>
                            <div class="font-bold text-xs capitalize text-gray-500 flex justify-between items-center">
                                <span class="max-w-[200px] md:max-w-[400px] overflow-hidden overflow-ellipsis">
                                    {{ $notification->data['description'] }}
                                </span>
                                <span class="text-xs text-gray-500 font-bold lowercase">
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