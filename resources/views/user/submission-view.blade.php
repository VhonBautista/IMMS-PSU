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

    <div class="bg-white p-6 rounded-lg">
        <nav class="flex mb-3" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li>
                    <div class="flex items-center">
                    <a href="{{ route('submission_management') }}" class="text-xs lg:text-sm font-medium text-gray-500 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{ __('Submissions') }}</a></a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                    <svg class="w-2 lg:w-3 h-2 lg:h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ml-1 font-semibold text-sm lg:text-lg text-gray-700 dark:text-gray-400">{{ __('Preview') }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="text-md my-6 font-bold tracking-widest text-gray-900 md:text-2xl dark:text-white capitalize flex flex-col justify-center items-center w-full">
            {{ $instructionalMaterial->title }}
            <span class="text-sm text-gray-600 tracking-wide">{{ $instructionalMaterial->department->department_name . ', ' . $instructionalMaterial->campus->campus_name . ' Campus' }}</span>
        </div>
        <div class="px-0 sm:px-6 flex gap-6 flex-wrap">
            <section>
                <h3 class="text-md text-center mb-1 sm:text-start font-bold leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white capitalize">
                    {{ __('Instructional Material Details') }}
                </h3>
                <div class="px-2">
                    <div class="text-sm mb-4 font-normal text-gray-600 capitalize flex flex-wrap items-end justify-between">
                        <div class="flex flex-wrap">
                            <span>
                                <strong>{{ __('Proponents: ') }}</strong>
                                {{ $instructionalMaterial->proponents }}
                            </span>
                            <span class="mx-3 hidden sm:block">|</span>
                            <span>
                                <strong>{{ __('Material Type: ') }}</strong>
                                {{ $instructionalMaterial->type }}
                            </span>
                        </div>
                        <div class="mt-3 sm:mt-0">
                            <span class="block text-sm text-center font-medium mr-2 px-2.5 py-1 rounded 
                                @if ($instructionalMaterial->status == 'approved')
                                    bg-green-100 text-green-800  dark:bg-green-900 dark:text-green-300
                                @elseif ($instructionalMaterial->status == 'resubmission')
                                    bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-300
                                @else
                                    bg-blue-100 text-blue-800 dark:bg-blue-700 dark:text-blue-300
                                @endif">
                                {{ $instructionalMaterial->status }}
                            </span>
                        </div>
                    </div>
                    <p class="text-sm mb-2 font-normal text-gray-600 leading-6 tracking-wider">
                        {{ __('The instructional material, entitled "') }}<strong>{{ $instructionalMaterial->title }}</strong>{{ __('," stands as a meticulously crafted learning resource tailored for the ') }}<strong>{{ $instructionalMaterial->course->course_name }}</strong>{{ __(' program within the ') }}<strong>{{ $instructionalMaterial->department->department_name }}</strong>{{ __('. Its submission on ') }}<strong>{{ date('F d, Y', strtotime($instructionalMaterial->created_at)) }}</strong>{{ __(', by the esteemed uploader, "') }}<strong>{{ $instructionalMaterial->user->firstname . ' ' . $instructionalMaterial->user->lastname }}</strong>{{ __('," marks a significant contribution to the academic landscape. The development of this instructional material was spearheaded by a team of accomplished individuals, whose collective expertise and dedication are reflected in its content and structure. The collaboration of these professionals, comprising the talented minds listed in the random order of names, underscores the commitment to creating a comprehensive and impactful educational resource for the benefit of students pursuing excellence in the field.') }}
                    </p>
                </div>
            </section>

            <section class="hidden w-full sm:block mb-4">
                <h3 class="text-md mb-3 font-bold leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white capitalize">
                    {{ __('PDF Viewer') }}
                </h3>
                
                <div id="accordion-viewer" data-accordion="collapse">
                    <h2 id="accordion-viewer-heading">
                        <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border rounded border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-viewer-body-" aria-expanded="false" aria-controls="accordion-viewer-body-">
                            <span>{{ __('Click to display File') }}</span>
                            <svg data-accordion-icon class="w-3 h-3 shrink-0" class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-viewer-body-" class="hidden" aria-labelledby="accordion-viewer-heading">
                        <div class="p-5">
                            @if (in_array(pathinfo($instructionalMaterial->pdf_path, PATHINFO_EXTENSION), ['pdf', 'docx']))
                                @if (pathinfo($instructionalMaterial->pdf_path, PATHINFO_EXTENSION) === 'pdf')
                                    <iframe class="px-2" src="{{ asset($instructionalMaterial->pdf_path) }}" width="100%" height="1200px" frameborder="0"></iframe>
                                @elseif (pathinfo($instructionalMaterial->pdf_path, PATHINFO_EXTENSION) === 'docx')
                                    <!-- Use Microsoft Office Viewer for DOCX files -->
                                    <iframe class="px-2" src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode(asset($instructionalMaterial->pdf_path)) }}" width="100%" height="1200px" frameborder="0"></iframe>
                                @endif
                            @elseif (in_array(pathinfo($instructionalMaterial->pdf_path, PATHINFO_EXTENSION), ['png', 'jpg', 'jpeg']))
                                <!-- Display image directly -->
                                <img src="{{ asset($instructionalMaterial->pdf_path) }}" alt="Image" class="w-full h-auto">
                            @else
                                <p>This file format is not supported for direct viewing. Please download the file to view.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            <section class="w-full mb-4">
                <h3 class="text-md mb-3 font-bold leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white capitalize">
                    {{ __('Evaluation History') }}
                </h3>
                <div class="w-full mt-3 mx-0 sm:mx-3 shadow rounded-lg mx-auto space-y-6">
                    <div class="relative border sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Status') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Evaluator') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Evaluation Details') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Evaluator\'s Comment') }}
                                    </th>
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
                                            <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">{{ $evaluation->evaluator->lastname . ', ' . $evaluation->evaluator->firstname . ' ' . $evaluation->evaluator->middlename }}</div>
                                            <div class="font-medium text-xs text-gray-500">{{ $evaluation->evaluator->email }}</div>
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
                                        <td class="px-6 py-4">
                                            <p class="font-medium text-xs text-gray-500">
                                                {{ $evaluation->comment }}
                                            </p>
                                        </td>
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
            </section>
        </div>
    </div>
</x-app-layout>
