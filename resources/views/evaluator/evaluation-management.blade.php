<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li aria-current="page">
                        <div class="flex items-center">
                        <span class="ml-1 font-semibold text-sm lg:text-lg text-gray-700 dark:text-gray-400">{{ __('Material Evaluation') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <div class="text-sm font-medium">
                @if ($user->evaluatorMatrix)
                    <div class="flex items-center text-green-600 ">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9h2v5m-2 0h4M9.408 5.5h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ml-2 text-sm font-medium">
                            {{ __('Matrix in use - ') . $user->evaluatorMatrix->matrix->matrix_name . __(' Matrix') }}
                        </div>
                    </div>
                @else
                    <div class="flex items-center text-red-600 ">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                          </svg>
                        <span class="sr-only">Info</span>
                        <div class="ml-2 text-sm font-medium">
                            {{ __('You are currently not assigned to any matrix') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </x-slot>

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
        <form action="{{ route('evaluator.evaluation_management') }}" method="GET" id="search-form" class="flex flex-col justify-center md:flex-row md:justify-between">
            <label for="search-user" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    
            <div class="flex w-full flex-wrap">
                <div class="w-full lg:w-auto px-0 lg:px-1 pb-3 lg:pb-0">
                    <select name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" onchange="submitSearch()">
                        <option value="" @if(!request('type')) selected @endif>Select Material Type</option>
                        <option value="course_book" @if(request('type') == 'course_book') selected @endif>Course Book</option>
                        <option value="textbook" @if(request('type') == 'textbook') selected @endif>Textbook</option>
                        <option value="modules" @if(request('type') == 'modules') selected @endif>Modules</option>
                        <option value="laboratory_manual" @if(request('type') == 'laboratory_manual') selected @endif>Laboratory Manual</option>
                        <option value="prototype" @if(request('type') == 'prototype') selected @endif>Prototype</option>
                        <option value="others" @if(request('type') == 'others') selected @endif>Others</option>
                    </select>
                </div>
            </div>                   
    
            <div class="relative w-full md:w-3/4">
                <input type="search" id="search-user" name="search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border-r-gray-50 border-r-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-r-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search for instructional materials by title" value="{{ request('search') }}">
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
                                {{ __('Instructional Material') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Submitter') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Campus') }}
                            </th>
                            <th scope="col" class="px-6 py-3"  id="date-column">
                                {{ __('Date Submitted') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">{{ __('Actions') }}</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($forEvaluationMaterials as $evaluationMaterial)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">{{ $evaluationMaterial->instructionalMaterial->title }}</div>
                                    <div class="font-medium text-xs text-gray-500 capitalize truncate ... max-w-[300px]">
                                        {{ str_replace('_', ' ', $evaluationMaterial->instructionalMaterial->type)}} <span class="lowercase">{{ __('for') }}</span> {{ $evaluationMaterial->instructionalMaterial->course->course_name }}
                                    </div>
                                </th>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-500 whitespace-nowrap dark:text-white">
                                    <div class="font-medium text-sm capitalize">{{ $evaluationMaterial->instructionalMaterial->user->lastname . ', ' . $evaluationMaterial->instructionalMaterial->user->firstname . ' ' . $evaluationMaterial->instructionalMaterial->user->middlename }}</div>
                                    <div class="font-medium text-xs">{{ $evaluationMaterial->instructionalMaterial->user->email }}</div>
                                </td>
                                <td class="px-6 py-4 capitalize" id="date-column">
                                    {{ $evaluationMaterial->instructionalMaterial->campus->campus_name }}
                                </td>
                                <td class="px-6 py-4 capitalize" id="date-column">
                                    {{ $evaluationMaterial->instructionalMaterial->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('submission_management.view', $evaluationMaterial->id) }}" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            <svg class="w-4 h-4 me-2 text-white transition duration-75 group-hover:text-blue-700 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                                <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v3H7V2Zm5.7 8.289-3.975 3.857a1 1 0 0 1-1.393 0L5.3 12.182a1.002 1.002 0 1 1 1.4-1.436l1.328 1.289 3.28-3.181a1 1 0 1 1 1.392 1.435Z"/>
                                            </svg>
                                            <span>{{ __('Evaluate') }}</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td colspan="7" class="px-6 py-4 text-center">
                                    <div class="p-4 text-sm">
                                        {{ __('No evaluation materials are available, or you have not been assigned to a matrix yet.') }}
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $forEvaluationMaterials->links() }}
        </div>
    </div>
    
    @section('scripts')
        <script src="{{ asset('js/search-filter.js') }}"></script>
        <script src="{{ asset('js/functions.js') }}"></script>
    @endsection
</x-app-layout>