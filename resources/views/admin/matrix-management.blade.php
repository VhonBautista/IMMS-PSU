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
                        <svg class="w-2 lg:w-3 h-2 lg:h-3 text-gray-400 mx-0 lg:mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ml-1 font-medium text-sm lg:text-lg text-gray-700 dark:text-gray-400">{{ __('Matrix Management') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            
            <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-matrix-modal')" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-gray-800 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                <svg class="w-4 h-4 text-white lg:me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.546.5a9.5 9.5 0 1 0 9.5 9.5 9.51 9.51 0 0 0-9.5-9.5ZM13.788 11h-3.242v3.242a1 1 0 1 1-2 0V11H5.304a1 1 0 0 1 0-2h3.242V5.758a1 1 0 0 1 2 0V9h3.242a1 1 0 1 1 0 2Z"/>
                </svg>
                <span class="hidden lg:block">
                    {{ __('Add Matrix') }}
                </span>
            </button>
        </div>
    </x-slot>

    {{-- Add Matrix Modal --}}
    <x-modal name="add-matrix-modal" focusable>
        <div class="p-6">
            <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                {{ __('Add New Matrix') }}
            </h3>

            <form class="space-y-4 md:space-y-6 w-full" method="POST" action="{{ route('admin.matrix_management.store') }}">
                @csrf
                
                <div class="w-full">
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Matrix Name') }}</label>
                    <input type="text" name="matrix_name" id="matrix_name" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Enter the name for the matrix') }}" required>
                    <x-input-error :messages="$errors->get('matrix_name')" class="mt-1" />
                </div>

                <div class="w-full">
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Description') }}</label>
                    <textarea rows="4" name="description" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter the description for the matrix" required></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-1" />
                </div>

                <div class="w-full">
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Matrix Level') }}</label>
                    <div class="flex items-start w-full">
                        <select name="level" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" required>
                            <option value="campus" selected>{{ __('Campus Level') }}</option>
                            <option value="university">{{ __('University Level') }}</option>
                        </select>
                    </div>
                </div>

                <div class="mt-5 pt-5 flex justify-between lg:justify-end">
                    <x-primary-button class="sm:w-44" type='submit'>
                        {{ __('Add Matrix') }}
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
        <form action="{{ route('admin.matrix_management') }}" method="GET" id="search-form" class="flex flex-col justify-center md:flex-row md:justify-between">
            <label for="search-user" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    
            
            <div class="flex w-full flex-wrap">
                <div class="w-full lg:w-auto px-0 lg:px-1 pb-3 lg:pb-0">
                    <select name="level" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" onchange="submitSearch()">
                      <option value="" @if(!request('level')) selected @endif>Select Matrix Level</option>
                      <option value="campus" @if(request('level') == 'campus') selected @endif>{{ __('Campus Level') }}</option>
                      <option value="university" @if(request('level') == 'university') selected @endif>{{ __('University Level') }}</option>
                    </select>
                </div>
            </div>              
    
            <div class="relative w-full md:w-3/4">
                <input type="search" id="search-user" name="search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border-r-gray-50 border-r-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-r-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search for matrices by matrix name" value="{{ request('search') }}">
                <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-gray-800 rounded-r-lg border border-gray-800 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </form>

        <div class="max-w-7xl mx-0 lg:mx-auto space-y-6">
            <div class="relative overflow-x-auto">
                <div id="accordion-collapse" data-accordion="open">
                    @forelse( $matrices as $matrix )
                        <h2 id="accordion-collapse-heading-{{ $matrix->id }}" class="mt-3">
                            <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-{{ $matrix->id }}" aria-expanded="true" aria-controls="accordion-collapse-body-{{ $matrix->id }}">
                                <span class="text-md font-bold capitalize">{{ $matrix->matrix_name . ' (' . $matrix->level . ' Level)' }}</span>
                                <svg data-accordion-icon class="w-3 h-3 shrink-0" class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-collapse-body-{{ $matrix->id }}" class="hidden" aria-labelledby="accordion-collapse-heading-{{ $matrix->id }}">
                            <div class="p-5 border border-gray-200 dark:border-gray-700">
                                <h1 class="text-md font-medium w-full flex justify-between items-center leading-tight tracking-tight text-gray-900 dark:text-white">
                                    {{ __('Description') }}

                                    <div>
                                        <a href="{{ route('admin.matrix_management.manage', [$matrix->id]) }}" class="px-3 py-2 mx-0 lg:mx-1 mb-2 text-xs font-medium tracking-wide text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            <svg class="w-3 h-3 text-white lg:me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M18 7.5h-.423l-.452-1.09.3-.3a1.5 1.5 0 0 0 0-2.121L16.01 2.575a1.5 1.5 0 0 0-2.121 0l-.3.3-1.089-.452V2A1.5 1.5 0 0 0 11 .5H9A1.5 1.5 0 0 0 7.5 2v.423l-1.09.452-.3-.3a1.5 1.5 0 0 0-2.121 0L2.576 3.99a1.5 1.5 0 0 0 0 2.121l.3.3L2.423 7.5H2A1.5 1.5 0 0 0 .5 9v2A1.5 1.5 0 0 0 2 12.5h.423l.452 1.09-.3.3a1.5 1.5 0 0 0 0 2.121l1.415 1.413a1.5 1.5 0 0 0 2.121 0l.3-.3 1.09.452V18A1.5 1.5 0 0 0 9 19.5h2a1.5 1.5 0 0 0 1.5-1.5v-.423l1.09-.452.3.3a1.5 1.5 0 0 0 2.121 0l1.415-1.414a1.5 1.5 0 0 0 0-2.121l-.3-.3.452-1.09H18a1.5 1.5 0 0 0 1.5-1.5V9A1.5 1.5 0 0 0 18 7.5Zm-8 6a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7Z"/>
                                            </svg>
                                            <span class="hidden lg:block">
                                                {{ __('Manage Matrix') }}
                                            </span>
                                        </a>
        
                                        <button type="button" onclick="setDeleteTitleFormAction('delete-matrix-id-input', {{ $matrix->id }}, 'delete-matrix-id-input', {{ $matrix->id }})" x-data="" x-on:click.prevent="$dispatch('open-modal', 'delete-matrix-modal')" class="mx-0 lg:mx-1 px-3 py-2 mb-2 text-xs font-medium tracking-wide text-center inline-flex items-center text-white bg-red-600 rounded-lg hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                            <svg class="w-3 h-3 text-white lg:me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                                <path d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z"/>
                                              </svg>
                                            <span class="hidden lg:block">
                                                {{ __('Delete Matrix') }}
                                            </span>
                                        </button>
                                    </div>
                                </h1>
                                <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">{{ $matrix->description }}</p>

                                <h1 class="text-md mb-2 font-medium leading-tight tracking-tight text-gray-900 dark:text-white">
                                    {{ __('Matrix Details') }}
                                </h1>
                                <div class="flex flex-wrap gap-5">
                                    <div class="border border-1 p-3 md:p-6 bg-white rounded-lg flex-1">
                                        <h1 class="text-lg flex w-full items-center justify-between text-center md:text-start font-medium leading-tight tracking-tight text-gray-900 dark:text-white">
                                            {{ $matrix->matrix_name }}
                                        </h1>
                                        <div class="px-2 pt-3 text-gray-500 dark:text-gray-400">
                                            <div id="accordion-flush" data-accordion="open" data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
                                                @forelse( $matrix->subMatrices->sortBy('title') as $subMatrix )
                                                    <h2 id="accordion-flush-heading-{{ $matrix->id . '-' . $subMatrix->id}}">
                                                        <button type="button" class="flex px-2 items-center justify-between w-full py-2 font-medium rtl:text-right text-gray-800 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#accordion-flush-body-{{ $matrix->id . '-' . $subMatrix->id}}" aria-expanded="true" aria-controls="accordion-flush-body-{{ $matrix->id . '-' . $subMatrix->id}}">
                                                            <span class="text-sm font-medium">{{ $subMatrix->title }}</span>
                                                            <svg data-accordion-icon class="w-3 h-3 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                                            </svg>
                                                        </button>
                                                    </h2>
                                                    <div id="accordion-flush-body-{{ $matrix->id . '-' . $subMatrix->id}}" class="hidden" aria-labelledby="accordion-flush-heading-{{ $matrix->id . '-' . $subMatrix->id}}">
                                                        <div class="mb-4 py-2 border-b border-gray-200 dark:border-gray-700">
                                                            <ul class="ps-5 ms-3 text-gray-500 list-disc dark:text-gray-400">
                                                                @forelse( $subMatrix->matrixItems->sortBy('item') as $matrixItem )
                                                                    <li>
                                                                        <div class="flex w-full justify-between items-center text-sm mb-1">
                                                                            <div class="flex items-center gap-1">
                                                                                <span class="text-gray-600 font-normal dark:text-gray-500">{{ $matrixItem->item }}</span>
                            
                                                                                <svg class="w-3 h-3 text-gray-800 dark:text-white" data-tooltip-placement="bottom" data-tooltip-target="tooltip-text-{{ $matrix->id . '-' . $subMatrix->id . '-' . $matrixItem->id }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9h2v5m-2 0h4M9.408 5.5h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                                                </svg>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div id="tooltip-text-{{ $matrix->id . '-' . $subMatrix->id . '-' . $matrixItem->id }}" role="tooltip" class="absolute z-10 max-w-[300px] invisible inline-block px-3 py-2 text-sm font-normal text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                                            {{ $matrixItem->text }}
                                                                        </div>
                                                                    </li>
                                                                @empty
                                                                    <div class="px-6 py-4 flex flex-col text-sm font-normal items-center text-center w-full text-gray-500 dark:text-gray-400">
                                                                        {{ __('No content available') }}
                                                                    </div>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="px-6 py-4 flex flex-col text-sm font-normal items-center text-center w-full text-gray-500 dark:text-gray-400">
                                                        {{ __('No content available') }}
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="border border-1 p-3 md:p-6 bg-white rounded-lg flex-1">
                                        <h1 class="text-lg flex w-full items-center justify-between text-center md:text-start font-medium leading-tight tracking-tight text-gray-900 dark:text-white">
                                            {{ __('Matrix Evaluators') }}
                                        </h1>
                                        <div class="px-2 pt-5 text-gray-800 dark:text-gray-400">
                                            @forelse( $matrix->evaluatorMatrices as $evaluatorMatrix )
                                                <div class="flex w-full gap-6 justify-between items-center text-sm mb-4">
                                                    <div scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">{{ $evaluatorMatrix->evaluator->lastname . ', ' . $evaluatorMatrix->evaluator->firstname . ' ' . $evaluatorMatrix->evaluator->middlename }}</div>
                                                        <div class="font-medium text-xs text-gray-500">{{ $evaluatorMatrix->evaluator->email }}</div>
                                                        <div class="font-medium text-xs text-gray-500">{{ $evaluatorMatrix->evaluator->universityRole->university_role }} at {{ $evaluatorMatrix->evaluator->campus->campus_name }} Campus</div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="px-6 py-4 flex flex-col text-sm font-normal items-center text-center w-full text-gray-500 dark:text-gray-400">
                                                    {{ __('No available university evaluators') }}
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white mt-3 border rounded-lg dark:bg-gray-800 px-6 py-4 text-center">
                            <div class="p-4 text-sm text-gray-500">
                                {{ __('There are no matrices available') }}
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        {{ $matrices->links() }}
    </div>

    {{-- Delete Sub Matrix Modal --}}
    <x-modal name="delete-matrix-modal" :maxWidth="'md'" focusable>
        <div class="p-6">
            <form class="space-y-4 md:space-y-6" id="delete-sub-matrix-form" method="POST" action="{{ route('admin.matrix_management.destroy') }}">
                @csrf
                @method('DELETE')
    
                <input type="hidden" name="matrix_id" id="delete-matrix-id-input" value="">

                <div class="text-center">
                    <svg class="mx-0 lg:mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        {{ __('Delete Matrix') }}
                    </h3>
                    <h3 class="mb-5 text-md font-medium text-gray-500 dark:text-gray-400">{{ __('Are you sure you want to delete this matrix? This action is irreversible and will also delete all contents.') }}</h3>
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