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
                        <span class="ml-1 font-semibold text-sm lg:text-lg text-gray-700 dark:text-gray-400">{{ __('Course College Management') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </x-slot>

    {{-- Add Courses Modal --}}
    <x-modal name="add-courses-modal" focusable>
        <div class="p-6">
            <h3 id="modal-title" class="text-xl font-semibold text-gray-900 dark:text-white"></h3>

            <form class="mt-3" method="POST" action="{{ route('admin.course_college_management.store') }}">
                @csrf
    
                <input type="hidden" name="college_id" id="college-id-input" value="">
                
                <div id="dynamicContentContainer"></div>

                <div class="mt-5 pt-5 flex justify-between lg:justify-end">
                    <x-primary-button class="sm:w-44" type='submit'>
                        {{ __('Add') }}
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
        <form action="{{ route('admin.course_college_management') }}" method="GET" id="search-form" class="flex flex-col justify-center md:flex-row md:justify-between">
            <label for="search-user" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    
            <div class="flex w-full flex-wrap">
                <div class="w-full md:w-auto px-0 lg:px-1 lg:pb-0">
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
    
        <div class="max-w-7xl mx-auto space-y-6">
            <div class="relative overflow-x-auto">
                <div id="accordion-collapse" data-accordion="open">
                    @forelse( $colleges as $college )
                        <h2 id="accordion-collapse-heading-{{ $college->id }}" class="mt-3">
                            <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-{{ $college->id }}" aria-expanded="true" aria-controls="accordion-collapse-body-{{ $college->id }}">
                                <span class="text-md font-bold">{{ $college->college_name }}</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                            </button>
                        </h2>
                        <div id="accordion-collapse-body-{{ $college->id }}" class="hidden" aria-labelledby="accordion-collapse-heading-{{ $college->id }}">
                            <div class="p-5 border border-gray-200 dark:border-gray-700">
                                <h1 class="text-sm font-medium leading-tight tracking-tight text-gray-900 dark:text-white">
                                    {{ __('Description') }}
                                </h1>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">{{ $college->description }}</p>
                                <h1 class="text-sm font-medium leading-tight tracking-tight text-gray-900 dark:text-white">
                                    {{ __('Courses') }}
                                </h1>
                                <ul class="ps-5 text-gray-500 list-disc dark:text-gray-400">
                                    @forelse( $college->courses->sortBy('course_name') as $course )
                                        <li>
                                            <div class="flex w-full justify-between items-center text-sm mb-1">
                                                <a data-tooltip-target="tooltip-edit-{{ $college->id . '-' . $course->id }}" href="{{ route('admin.course_management.edit', ['id' => $course->id]) }}" class="text-blue-600 dark:text-blue-500 hover:underline">{{ $course->course_name }}</a>

                                                <a data-tooltip-target="tooltip-remove-{{ $college->id . '-' . $course->id }}" href="{{ route('admin.course_college_management.remove', ['collegeId' => $college->id, 'courseId' => $course->id]) }}" class="cursor-pointer text-red-600 hover:text-red-500">Remove</a>
                                            </div>
                                            
                                            <div id="tooltip-edit-{{ $college->id . '-' . $course->id }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                Edit Course
                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                            </div>

                                            <div id="tooltip-remove-{{ $college->id . '-' . $course->id }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                Remove  {{ $course->course_name }}
                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                            </div>
                                        </li>
                                    @empty
                                        <div class="px-6 py-4 flex flex-col items-center text-center w-full text-gray-500 dark:text-gray-400">
                                            {{ __('No available courses') }}
                                        </div>
                                    @endforelse
                                </ul>
                                <button type="button" onclick="setCourseCollegeFormAction('modal-title', '{{ $college->college_name }}', 'college-id-input', {{ $college->id }})" x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-courses-modal')" class="w-full md:w-1/2 mt-2 px-3 py-2 text-xs font-medium text-center rounded-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 border border-gray-400 dark:border-gray-500 text-gray-500 dark:hover:text-white dark:hover:bg-gray-500">{{ __('Add Courses to ' . $college->college_name) }}</button>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white border rounded-lg dark:bg-gray-800 px-6 py-4 text-center">
                            <div class="p-4 text-sm text-gray-500">
                                {{ __('There are no records') }}
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        {{ $colleges->links() }}
    </div>

    @section('scripts')
        <script src="{{ asset('js/search-filter.js') }}"></script>
        <script src="{{ asset('js/functions.js') }}"></script>
    @endsection
</x-app-layout>