@php
    $user = auth()->user();
    $role = $user->role_id;
@endphp

<nav x-data="{ open: false }" class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 z-10">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="flex w-full justify-center items-center">
                        <img class="w-8 h-8 mx-2" src="{{ asset('assets/system/Pangasinan_State_University_logo.png') }}" alt="logo">
                        <div>
                            <h1 class="text-lg md:text-md font-bold leading-tight tracking-widest text-gray-900 dark:text-white">
                                {{ __('PSU I.M.M.S.') }}
                            </h1>
                            <h1 class="text-xs font-bold tracking-tighter sm:tracking-wide text-gray-900 dark:text-white">
                                {{ __('Instructional Material Management System') }}
                            </h1>
                        </div>
                    </a>
                </div>
            </div>
            
            <div class="flex items-center">
                <!-- Navigation Links -->
                <div class="hidden sm:-my-px sm:ms-10 sm:flex">
                    <div class="text-sm font-medium text-center text-gray-500">
                        <ul class="flex flex-wrap -mb-px">
                            @yield('links')
                        </ul>
                    </div>
                </div>
                
                <div class="flex items-center hidden sm:block">
                    <div class="flex items-center ml-3">
                        <button 
                        id="dropdownNotificationButton" 
                        data-dropdown-toggle="dropdownNotification" 
                        class="inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none dark:hover:text-white dark:text-gray-400 mr-2"
                        type="button" data-dropdown-offset-distance="20">
                            @if ($user->unreadNotifications->isNotEmpty())
                            <div class="relative flex">
                                <div class="relative inline-flex w-3 h-3 bg-red-500 border-2 border-white rounded-full -top-2 left-5 dark:border-gray-900"></div>
                            </div>
                            @endif
    
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20">
                                <path d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z"/>
                            </svg>
                        </button>
    
                        <!-- Dropdown menu -->
                        <div id="dropdownNotification" class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700" aria-labelledby="dropdownNotificationButton">
                            <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
                                {{ __('Notifications') }}
                            </div>
                            <div class="divide-y divide-gray-100 dark:divide-gray-700 max-h-[300px] overflow-y-auto">
                                @forelse($user->unreadNotifications as $notification)
                                <a href="{{ $notification->data['route'] !== 'none' ? route($notification->data['route']) : '' }}" onclick="event.preventDefault(); markNotificationAsReadAndRedirect(this, '{{ route('mark-as-read', ['id' => $notification->id]) }}')" class="flex justify-center md:justify-start items-center w-full px-0 md:px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700"> 
                                        {{-- Icons --}}
                                        @switch($notification->data['action'])
                                            @case('added')
                                            @case('created')
                                            @case('registered')
                                                <svg class="w-7 h-7 text-blue-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                                @break
    
                                            @case('deleted')
                                            @case('rejected')
                                            @case('removed')
                                                <svg class="w-7 h-7 text-red-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                                @break
    
                                            @case('approved')
                                                <svg class="w-7 h-7 text-green-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 10 2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                                @break
    
                                            @default
                                                <svg class="w-7 h-7 text-violet-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9h2v5m-2 0h4M9.408 5.5h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                        @endswitch
    
                                        {{-- Details --}}
                                        <div scope="row" class="px-4 py-2 w-full font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">
                                                {{ $notification->data['title'] }}
                                                
                                            </div>
                                            <div class="font-medium text-xs capitalize text-gray-500 flex justify-between items-center">
                                                <span class="max-w-[200px] overflow-hidden overflow-ellipsis">
                                                    {{ $notification->data['description'] }}
                                                </span>
                                                <span class="text-xs text-gray-500 font-normal lowercase">
                                                    {{ $notification->created_at->diffForHumans(null, false, true, 1) }}
                                                </span>
                                            </div>
                                        </div>                                    
                                    </a>
                                @empty
                                    <div class="flex justify-center items-center w-full h-full">
                                        <div class="p-4 text-sm">
                                            {{ __('There are no new notifications') }}
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                            <a href="{{ route('admin.notification') }}" class="block px-4 py-2 text-center text-sm text-blue-700 rounded-b-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
                                {{ __('All Notifications') }}
                            </a>
                        </div>
    
                        <div>
                            <button data-dropdown-toggle="dropdownUser" class="flex items-center text-sm pe-1 font-medium text-gray-900 rounded-full hover:text-blue-600 dark:hover:text-blue-500 md:me-0 dark:text-white pl-1 md:pl-2" type="button" data-dropdown-offset-distance="18">
                                <span class="sr-only">Open user menu</span>
                                {{ $user->firstname . ' ' . $user->lastname }}
                                <svg class="w-2.5 h-2.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdownUser">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    {{ $user->firstname . ' ' . $user->lastname }}
                                </p>
                                <p class="text-sm text-gray-500 truncate" role="none">
                                    {{ $user->email }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">{{ __('Profile') }}</a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
    
                                        <span class="cursor-pointer block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" onclick="event.preventDefault(); this.closest('form').submit();" role="menuitem">{{ __('Log Out') }}</span>
                                    </form>
                                </li>
                            </ul>
                        </div>

                        <svg x-data="" x-on:click.prevent="$dispatch('open-modal', 'idiot-board-modal')" class="w-4 h-4 ms-2 text-gray-800 dark:text-white cursor-pointer" data-tooltip-target="tooltip-default" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.529 7.988a2.502 2.502 0 0 1 5 .191A2.441 2.441 0 0 1 10 10.582V12m-.01 3.008H10M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>

                        <div id="tooltip-default" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            {{ __('How to use IMMS') }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Idiot Modal --}}
            <x-modal name="idiot-board-modal" focusable>
                <div class="p-6">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        {{ __('How to use our IMMS?') }}
                    </h3>
                    <h3 class="text-sm font-normal text-gray-600 dark:text-white">
                        {{ __('IMMS (Instructional Material Management System) is a robust platform that efficiently organizes, distributes, and tracks educational resources within institutions, ensuring a seamless and effective learning experience for educators and students.') }}
                    </h3>

                    <div id="default-carousel" class="relative w-full mt-3" data-carousel="static">
                        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                            <!-- Item 1 -->
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <img src="https://images.unsplash.com/photo-1704551291212-332cad801af3?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                            </div>
                            <!-- Item 2 -->
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <img src="https://images.unsplash.com/photo-1704551291212-332cad801af3?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                            </div>
                            <!-- Item 3 -->
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <img src="https://images.unsplash.com/photo-1704551291212-332cad801af3?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                            </div>
                            <!-- Item 4 -->
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <img src="https://images.unsplash.com/photo-1704551291212-332cad801af3?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                            </div>
                            <!-- Item 5 -->
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <img src="https://images.unsplash.com/photo-1704551291212-332cad801af3?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                            </div>
                        </div>
                        <!-- Slider indicators -->
                        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
                            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
                        </div>
                        <!-- Slider controls -->
                        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                </svg>
                                <span class="sr-only">Previous</span>
                            </span>
                        </button>
                        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                                <span class="sr-only">Next</span>
                            </span>
                        </button>
                    </div>
                </div>
            </x-modal>
            {{-- Modal End --}}

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @yield('burger_links')
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4" role="none">
                <p class="font-medium text-base text-gray-800 dark:text-gray-200" role="none">
                    {{ $user->firstname . ' ' . $user->lastname }}
                </p>
                <p class="font-medium text-sm text-gray-500 truncate" role="none">
                    {{ $user->email }}
                </p>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
