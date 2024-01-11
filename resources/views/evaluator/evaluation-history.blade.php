<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li aria-current="page">
                        <div class="flex items-center">
                        <span class="ml-1 font-semibold text-sm lg:text-lg text-gray-700 dark:text-gray-400">{{ __('Evaluation History') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <div class="bg-white p-6 rounded-lg">
        <div class="flex w-full flex-wrap items-center justify-between">
            <form action="{{ route('evaluator.evaluation_management.history') }}" method="GET" id="daterange-form">
                <div class="flex flex-wrap justify-between items-center">
                    <div date-rangepicker class="flex items-center">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input name="start" type="text" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
                        </div>
                        <span class="mx-4 text-gray-500">to</span>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            
                            <input name="end" id="end" type="text" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
                        </div>
                        <button type="submit" class="p-2.5 text-sm font-medium h-full text-white bg-gray-800 rounded-r-lg border border-gray-800 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                            {{ __('Go') }}
                        </button>
                    </div>
                </div>
            </form> 
            
            <form action="{{ route('evaluator.evaluation_management.history') }}" method="GET" id="search-form" class="w-full mt-3 sm:mt-0 lg:w-[300px]">   
                <div class="relative w-full">
                    <input type="search" id="search-user" name="search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border-r-gray-50 border-r-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-r-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search by submitter or material title" value="{{ request('search') }}">
                    <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-gray-800 rounded-r-lg border border-gray-800 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white pb-6 pt-0 rounded-lg">        
            <div class="max-w-7xl mt-3 mx-auto space-y-6">
                <div class="relative overflow-x-auto border sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('Status') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('Submitter') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('Evaluation Details') }}
                                </th>
                                {{-- <th scope="col" class="px-6 py-3">
                                    {{ __('Comment') }}
                                </th> --}}
                                <th scope="col" class="px-6 py-3">
                                    {{ __('Date Evaluated') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($evaluations as $evaluation)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 capitalize">
                                        <span class="block text-sm text-center font-medium mr-2 px-2.5 py-1 rounded 
                                            @if ($evaluation->status == 'passed')
                                                bg-green-100 text-green-800  dark:bg-green-900 dark:text-green-300
                                            @else
                                                bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-300
                                            @endif">
                                            {{ $evaluation->status }}
                                        </span>
                                    </td>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">{{ $evaluation->instructionalMaterial->user->lastname . ', ' . $evaluation->instructionalMaterial->user->firstname . ' ' . $evaluation->instructionalMaterial->user->middlename }}</div>
                                        <div class="font-medium text-xs text-gray-500">{{ $evaluation->instructionalMaterial->user->email }}</div>
                                        <div class="font-medium text-xs text-gray-500">{{ $evaluation->evaluator->universityRole->university_role . ' at ' . $evaluation->evaluator->campus->campus_name . ' Campus' }}</div>
                                    </th>
                                    <td class="px-6 py-4">
                                        <p class="font-medium text-xs text-gray-500 capitalize">
                                            {{ $evaluation->matrix->matrix_name . ' Matrix (' . $evaluation->matrix->level . ' Level)'  }}
                                            <div class="font-medium text-xs text-blue-600 cursor-pointer hover:underline dark:text-gray-200 capitalize " data-tooltip-trigger="click" data-tooltip-target="tooltip-text-{{ $evaluation->id }}" aria-hidden="true">
                                                {{ __('View Passed Criteria Details') }}
                                            </div>
                                        </p>

                                        <div id="tooltip-text-{{ $evaluation->id }}" role="tooltip"
                                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
                                            {!! $evaluation->passed_criteria !!}
                                        </div>
                                    </td>
                                    {{-- <td class="px-6 py-4">
                                        <p class="font-medium text-xs text-gray-500">
                                            {{ $evaluation->comment }}
                                        </p>
                                    </td> --}}
                                    <td class="px-6 py-4 text-xs capitalize">
                                        {{ $evaluation->created_at->format('M d, Y h:i A') }}
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
                {{ $evaluations->links() }}
            </div>
        </div>
    </div>
</x-app-layout>