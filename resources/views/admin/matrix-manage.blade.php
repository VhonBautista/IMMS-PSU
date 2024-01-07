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
                    <a href="{{ route('admin.matrix_management') }}" class="ml-1 text-xs lg:text-sm font-medium text-gray-500 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{ __('Matrix Management') }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                    <svg class="w-2 lg:w-3 h-2 lg:h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ml-1 font-semibold text-sm lg:text-lg text-gray-700 dark:text-gray-400">{{ __('Matrix') }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    {{-- Add Sub Matrix Modal --}}
    <x-modal name="add-sub-matrix-modal" focusable>
        <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                {{ __('Add New Title') }}
            </h3>

            <form class="space-y-4 md:space-y-6 w-full" method="POST" action="{{ route('admin.matrix_management.title.store') }}">
                @csrf
                
                <input type="hidden" name="matrix_id" id="matrix-id-input" value="">

                <div class="w-full">
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Title') }}</label>
                    <input type="text" name="sub_matrix_name" id="sub_matrix_name" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Enter the title for the matrix items') }}" required>
                    <x-input-error :messages="$errors->get('sub_matrix_name')" class="mt-1" />
                </div>
                        
                <div class="mt-5 pt-5 flex justify-between lg:justify-end">
                    <x-primary-button class="sm:w-44" type='submit'>
                        {{ __('Add Title') }}
                    </x-primary-button>
    
                    <x-secondary-button x-on:click="$dispatch('close')" class="ms-3 sm:w-44">
                        {{ __('Cancel') }}
                    </x-secondary-button>
                </div>
            </form>
        </div>
    </x-modal>
    {{-- Modal End --}}

    {{-- Add Matrix Item Modal --}}
    <x-modal name="add-matrix-item-modal" focusable>
        <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                {{ __('Add New Item') }}
            </h3>
            <span class="text-xs font-medium text-gray-600"><strong>{{ __('Important! ') }}</strong>{{ __('Ensure accurate details and descriptions during input to prevent the need for redoing; note that this item is non-editable.') }}</span>

            <form class="space-y-4 md:space-y-6 w-full" method="POST" action="{{ route('admin.matrix_management.item.store') }}">
                @csrf
                
                <input type="hidden" name="sub_matrix_id" id="sub-matrix-id-input" value="">
                <input type="hidden" name="matrix_id" id="item-matrix-id-input" value="">

                <div class="w-full">
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Item Name') }}</label>
                    <input type="text" name="matrix_item_name" id="matrix_item_name" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Enter the item name for the matrix item') }}" required>
                    <x-input-error :messages="$errors->get('matrix_item_name')" class="mt-1" />
                </div>
                
                <div class="w-full">
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Description') }}</label>
                    <textarea rows="4" name="description" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter the description for the matrix item" required></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-1" />
                </div>
                        
                <div class="mt-5 pt-5 flex justify-between lg:justify-end">
                    <x-primary-button class="sm:w-44" type='submit'>
                        {{ __('Add Item') }}
                    </x-primary-button>
    
                    <x-secondary-button x-on:click="$dispatch('close')" class="ms-3 sm:w-44">
                        {{ __('Cancel') }}
                    </x-secondary-button>
                </div>
            </form>
        </div>
    </x-modal>
    {{-- Modal End --}}

    {{-- Add Evaluator Modal --}}
    <x-modal name="add-evaluator-modal" focusable>
        <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('Add Matrix Evaluators') }}</h3>
            <span class="text-xs font-medium text-gray-600">{{ __('You can select a maximum of three evaluators per matrix.') }}</span>

            <form class="mt-3" method="POST" action="{{ route('admin.matrix_management.evaluator.store') }}"> 
                @csrf
    
                <input type="hidden" name="matrix_id" id="evaluator-matrix-id-input" value="">
                
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

    <div class="p-8 bg-white rounded-lg mt-6">
        <h1 class="text-md font-semibold leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white">
            {{ __('Matrix Information') }}
        </h1>

        <form action="{{ route('admin.matrix_management.update') }}" method="POST" class="space-y-6"> 
            @csrf
            @method('PATCH')

            <input type="hidden" name="matrix_id" value="{{ $matrix->id }}">

            <div class="w-full lg:w-3/4">
                <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Matrix Name') }}</label>
                <input type="text" name="matrix_name" id="matrix_name" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Enter the name for the matrix') }}" required value="{{ old('matrix_name', $matrix->matrix_name) }}">
                <x-input-error :messages="$errors->get('matrix_name')" class="mt-1" />
            </div>

            <div class="w-full lg:w-3/4">
                <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Description') }}</label>
                <textarea rows="6" name="description" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter the description for the matrix" required>{{ old('description', $matrix->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-1" />
            </div>

            <div>
                <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Matrix Level') }}</label>
                <div class="flex items-start w-full lg:w-3/4">
                    <select name="level" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" required>
                        <option value="campus" @if($matrix->level == 'campus') selected @endif>Campus Level</option>
                        <option value="university" @if($matrix->level == 'university') selected @endif>University Level</option>
                    </select>
                </div>
            </div>
    
            <div class="flex items-center gap-4">
                <x-primary-button class="sm:w-44">{{ __('Save') }}</x-primary-button>
                <x-secondary-button class="sm:w-44">
                    <a href="{{ route('admin.matrix_management') }}">
                        {{ __('Cancel') }}
                    </a>
                </x-secondary-button>
            </div>
        </form>
    </div>
    
    {{-- Alert --}}
    @if (session('detail-success'))
        <div id="alert-3" class="flex items-center p-4 mb-4 mt-5 text-green-800 rounded-lg bg-green-100 border border-2 border-green-500 dark:bg-gray-800 dark:text-green-400" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium">
                {{ session('detail-success') }}
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @elseif (session('detail-error'))
        <div id="alert-3" class="flex items-center p-4 mb-4 mt-5 text-red-800 rounded-lg bg-red-100 border border-2 border-red-500 dark:bg-gray-800 dark:text-red-400" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium">
                {{ session('detail-error') }}
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
        <h1 class="text-md font-semibold leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white">
            {{ __('Matrix Details') }}
        </h1>

        <div class="flex flex-wrap gap-5 pt-6">
            <div class="border border-1 p-3 md:p-6 bg-white rounded-lg flex-1">
                <h1 class="text-lg pb-3 mb-2 border-b flex w-full items-center justify-between text-center md:text-start font-semibold leading-tight tracking-tight text-gray-900 dark:text-white">
                    {{ $matrix->matrix_name }}
                    
                    <button type="button" onclick="setMatrixFormAction('matrix-id-input', {{ $matrix->id }})" x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-sub-matrix-modal')" class="px-3 py-2 text-xs font-medium tracking-wide text-center inline-flex items-center text-white bg-gray-800 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                        <svg class="w-3 h-3 text-white lg:me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.546.5a9.5 9.5 0 1 0 9.5 9.5 9.51 9.51 0 0 0-9.5-9.5ZM13.788 11h-3.242v3.242a1 1 0 1 1-2 0V11H5.304a1 1 0 0 1 0-2h3.242V5.758a1 1 0 0 1 2 0V9h3.242a1 1 0 1 1 0 2Z"/>
                        </svg>
                        <span class="hidden lg:block">
                            {{ __('Add Title') }}
                        </span>
                    </button>
                </h1>
                <span class="hidden sm:block text-xs font-medium text-gray-600">{{ __('View details about an item by hovering over it.') }}</span>
                <span class="block sm:hidden text-xs font-medium text-gray-600">{{ __('View details about an item by clicking it.') }}</span>
                <div class="px-2 pt-3 text-gray-500 dark:text-gray-400">
                    @forelse( $matrix->subMatrices->sortBy('title') as $subMatrix )
                        <div class="flex justify-between items-center w-full">
                            <span class="text-sm font-medium text-gray-800 capitalize">{{ $subMatrix->title }}</span>

                            <button type="button" onclick="setDoubleFormAction('delete-sub-matrix-id-input', {{ $subMatrix->id }}, 'delete-matrix-id-input', {{ $matrix->id }})" x-data="" x-on:click.prevent="$dispatch('open-modal', 'delete-sub-matrix-modal')" class="px-3 py-1 text-xs font-medium tracking-wide text-center inline-flex items-center text-white bg-red-600 rounded-lg hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-800 dark:focus:ring-red-800">
                                <svg class="w-3 h-3 text-white lg:me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                    <path d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z"/>
                                  </svg>
                                <span class="hidden lg:block">
                                    {{ __('Delete') }}
                                </span>
                            </button>
                        </div>
                        <div class="py-2 mb-6 border-b border-gray-200 dark:border-gray-700">
                            <ul class="ms-3 text-gray-500 dark:text-gray-400">
                                @forelse( $subMatrix->matrixItems->sortBy('item') as $matrixItem )
                                    <li class="flex justify-between items-center w-full pt-1">
                                        <div class="flex w-full justify-between items-center text-sm mb-1">
                                            <span class="cursor-auto text-gray-600 font-normal dark:text-gray-500" data-tooltip-placement="right" data-tooltip-target="tooltip-text-{{ $matrix->id . '-' . $subMatrix->id . '-' . $matrixItem->id }}" aria-hidden="true" >{{ $matrixItem->item }}</span>
                                        </div>

                                        <a data-tooltip-target="tooltip-remove-item-{{ $matrix->id . '-' . $subMatrix->id . '-' . $matrixItem->id }}" href="{{ route('admin.matrix_management.item.remove', ['matrixItemId' => $matrixItem->id, 'matrixId' => $matrix->id]) }}" data-tooltip-placement="right" class="text-sm cursor-pointer text-red-600 hover:text-red-500">
                                            <span>{{ __('Remove') }}</span>
                                        </a>

                                        <div id="tooltip-remove-item-{{ $matrix->id . '-' . $subMatrix->id . '-' . $matrixItem->id }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                            {{ __('Remove') }} {{ $matrixItem->item }}
                                        </div>
                                        
                                        <div id="tooltip-text-{{ $matrix->id . '-' . $subMatrix->id . '-' . $matrixItem->id }}" role="tooltip" class="absolute z-10 max-w-[400px] invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                            {{ $matrixItem->text }}
                                        </div>
                                    </li>
                                @empty
                                    <div class="px-6 py-4 flex flex-col text-sm font-medium items-center text-center w-full text-gray-500 dark:text-gray-400">
                                        {{ __('No content available') }}
                                    </div>
                                @endforelse
                            </ul>
                            <button type="button" onclick="setDoubleFormAction('sub-matrix-id-input', {{ $subMatrix->id }}, 'item-matrix-id-input', {{ $matrix->id }})" x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-matrix-item-modal')" class="w-full mb-2 mt-2 px-3 py-2 text-xs font-medium text-center rounded-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 border border-gray-400 dark:border-gray-500 text-gray-500 dark:hover:text-white dark:hover:bg-gray-500">{{ __('Add Item') }}</button>
                        </div>
                    @empty
                        <div class="px-6 py-4 flex flex-col text-sm font-medium items-center text-center w-full text-gray-500 dark:text-gray-400">
                            {{ __('No content available') }}
                        </div>
                    @endforelse
                </div>
            </div>
            
            <div class="border border-1 p-3 md:p-6 bg-white rounded-lg flex-1">
                <h1 class="text-lg flex w-full pb-3 border-b items-center justify-between text-center md:text-start font-semibold leading-tight tracking-tight text-gray-900 dark:text-white">
                    {{ __('Matrix Evaluators') }}

                    @if(count($matrix->evaluatorMatrices) < 2)
                        <button
                            data-url="{{ url('get-university-roles-for-matrix') }}"
                            data-matrix-id="{{ $matrix->id }}"
                            onclick="setEvaluatorFormAction('evaluator-matrix-id-input', this)"
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'add-evaluator-modal')"
                            class="px-3 py-2 text-xs font-medium tracking-wide text-center inline-flex items-center text-white bg-gray-800 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-800 dark:focus:ring-gray-800"
                        >
                            <svg class="w-3 h-3 text-white transition duration-75 group-hover:text-blue-700 dark:group-hover:text-white lg:me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                <path d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-2V5a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V9h2a1 1 0 1 0 0-2Z"/>
                            </svg>
                            <span class="hidden lg:block">{{ __('Add Evaluator') }}</span>
                        </button>
                    @else
                        <button class="py-2 text-xs font-medium tracking-tight text-end inline-flex items-center text-red-600 rounded-lg focus:ring-4 focus:outline-none focus:ring-gray-300" disabled>
                            <svg class="w-3 h-3 text-red-600 transition duration-75 group-hover:text-blue-700 dark:group-hover:text-white me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <span class="hidden lg:block">{{ __('Max Evaluator Limit Reached') }}</span>
                        </button>
                    @endif
                </h1>
                <div class="px-2 pt-3 text-gray-800 dark:text-gray-400">
                    @forelse( $matrix->evaluatorMatrices as $evaluatorMatrix )
                        <div class="flex w-full gap-6 justify-between items-center text-sm mb-4">
                            <div scope="row" class="font-medium text-gray-900 dark:text-white">
                                <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">{{ $evaluatorMatrix->evaluator->lastname . ', ' . $evaluatorMatrix->evaluator->firstname . ' ' . $evaluatorMatrix->evaluator->middlename }}</div>
                                <div class="font-medium text-xs text-gray-500">{{ $evaluatorMatrix->evaluator->email }}</div>
                                <div class="font-medium text-xs text-gray-500">{{ $evaluatorMatrix->evaluator->universityRole->university_role }} at {{ $evaluatorMatrix->evaluator->campus->campus_name }} Campus</div>
                            </div>
                            
                            <a data-tooltip-target="tooltip-remove-{{ $evaluatorMatrix->evaluator->id . '-' . $evaluatorMatrix->matrix->id }}" href="{{ route('admin.matrix_management.remove', ['evaluatorId' => $evaluatorMatrix->evaluator->id, 'matrixId' => $evaluatorMatrix->matrix->id]) }}" data-tooltip-placement="left" class="cursor-pointer text-red-600 hover:text-red-500">Remove</a>
                        </div>

                        <div id="tooltip-remove-{{ $evaluatorMatrix->evaluator->id . '-' . $evaluatorMatrix->matrix->id }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Remove {{ $evaluatorMatrix->evaluator->lastname . ', ' . $evaluatorMatrix->evaluator->firstname . ' ' . $evaluatorMatrix->evaluator->middlename }}
                        </div>
                    @empty
                        <div class="px-6 py-4 flex flex-col text-sm font-medium items-center text-center w-full text-gray-500 dark:text-gray-400">
                            {{ __('No available university evaluators') }}
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Sub Matrix Modal --}}
    <x-modal name="delete-sub-matrix-modal" :maxWidth="'md'" focusable>
        <div class="p-6">
            <form class="space-y-4 md:space-y-6" id="delete-sub-matrix-form" method="POST" action="{{ route('admin.matrix_management.title.destroy') }}">
                @csrf
                @method('DELETE')
    
                <input type="hidden" name="sub_matrix_id" id="delete-sub-matrix-id-input" value="">
                <input type="hidden" name="matrix_id" id="delete-matrix-id-input" value="">

                <div class="text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ __('Delete Sub Matrix') }}
                    </h3>
                    <h3 class="mb-5 text-md font-medium text-gray-500 dark:text-gray-400">{{ __('Are you sure you want to delete this sub-matrix? This action is irreversible and will also delete all associated matrix items.') }}</h3>
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
        <script src="{{ asset('js/functions.js') }}"></script>
    @endsection
</x-app-layout>