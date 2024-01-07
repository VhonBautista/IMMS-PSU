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

    {{-- Resubmit Modal --}}
    <x-modal name="resubmit-modal" focusable>
        <div class="p-6">
            <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                {{ __('Return Material for Resubmission') }}
            </h3>

            <form class="space-y-4 md:space-y-6 w-full" method="POST" action="{{ route('evaluator.evaluation_management.store') }}">
                @csrf
                
                <input type="hidden" name="matrix_id" value="{{ $matrix->id }}">
                <input type="hidden" name="material_id" value="{{ $instructionalMaterial->id }}">
                <input type="hidden" name="status" value="failed">
                <input type="hidden" id="resubmit-passed-criteria" name="passed_criteria" value="">

                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Passed Criteria') }}</label>
                    <p class="w-full text-gray-900 text-sm pt-1 px-2.5">
                        <span id="display-resubmit-passed-criteria"></span>
                    </p>
                </div>

                <div class="w-full">
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Remarks') }}</label>
                    <textarea rows="4" name="comment" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Provide additional comments regarding this instructional material." required></textarea>
                    <x-input-error :messages="$errors->get('comment')" class="mt-1" />
                </div>
                        
                <div class="mt-5 pt-5 flex justify-between lg:justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')" class="sm:w-44">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-primary-button class="ms-3 sm:w-44 bg-red" type='submit'>
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>
    {{-- Modal End --}}

    {{-- Approve Modal --}}
    <x-modal name="approve-modal" focusable>
        <div class="p-6">
            <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                {{ __('Aprrove Material') }}
            </h3>

            <form class="space-y-4 md:space-y-6 w-full" method="POST" action="{{ route('evaluator.evaluation_management.store') }}">
                @csrf
                
                <input type="hidden" name="matrix_id" value="{{ $matrix->id }}">
                <input type="hidden" name="material_id" value="{{ $instructionalMaterial->id }}">
                <input type="hidden" name="status" value="passed">
                <input type="hidden" id="approve-passed-criteria" name="passed_criteria" value="">

                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Passed Criteria') }}</label>
                    <p class="w-full text-gray-900 text-sm pt-1 px-2.5">
                        <span id="display-approve-passed-criteria"></span>
                    </p>
                </div>

                <div class="w-full">
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Remarks') }}</label>
                    <textarea rows="4" name="comment" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Provide additional comments regarding this instructional material." required></textarea>
                    <x-input-error :messages="$errors->get('comment')" class="mt-1" />
                </div>
                        
                <div class="mt-5 pt-5 flex justify-between lg:justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')" class="sm:w-44">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-primary-button class="ms-3 sm:w-44 bg-red" type='submit'>
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>
    {{-- Modal End --}}

    {{-- Drawer Component --}}
    <div class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-72 dark:bg-gray-800 transform-none pt-20 shadow" tabindex="-1">
        <div class="flex-col items-center justify-between w-full">
            <h5 class="text-base font-semibold text-gray-800 uppercase dark:text-gray-400">{{ __('Material Matrix') }}</h5>
            <span class="hidden sm:block text-xs font-medium text-gray-600">{{ __('To learn more about a specific criterion, hover your mouse over it.') }}</span>
        </div>

        <div class="overflow-y-auto">
            @forelse ( $matrix->subMatrices as $subMatrix )
                <ul class="text-gray-500 px-2 list-disc dark:text-gray-400">
                    <div class="text-sm mt-4 mb-1 font-medium text-gray-800 dark:text-gray-300 capitalize">{{ $subMatrix->title }}</div>
                    @forelse($subMatrix->matrixItems->sortBy('item') as $matrixItem)
                        <li class="ms-2 my-1.5 flex full items-center justify-between">
                            <div class="flex w-full justify-between items-center text-sm mb-1">
                                <div class="flex items-center gap-1">
                                    <span class="text-gray-600 font-normal dark:text-gray-500" data-tooltip-placement="bottom" data-tooltip-target="tooltip-text-{{ $matrix->id . '-' . $subMatrix->id . '-' . $matrixItem->id }}" aria-hidden="true">{{ $matrixItem->item }}</span>
                                </div>
                            </div>

                            <input type="checkbox" value="{{ $matrixItem->item }}"
                                class="me-2 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 checkbox-item"
                                id="{{ $instructionalMaterial->id . '-' . $matrix->id . '-' . $subMatrix->id . '-' . $matrixItem->id }}">

                            <div id="tooltip-text-{{ $matrix->id . '-' . $subMatrix->id . '-' . $matrixItem->id }}" role="tooltip"
                                class="absolute z-10 max-w-[300px] invisible inline-block px-3 py-2 text-sm font-normal text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                {{ $matrixItem->text }}
                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var checkbox = document.getElementById("{{ $instructionalMaterial->id . '-' . $matrix->id . '-' . $subMatrix->id . '-' . $matrixItem->id }}");
                                    var key = checkbox.id;
                                    var isChecked = localStorage.getItem(key);

                                    if (isChecked === "true") {
                                        checkbox.checked = true;
                                    }

                                    checkbox.addEventListener("change", function() {
                                        localStorage.setItem(key, this.checked);
                                    });
                                });
                            </script>
                        </li>
                    @empty
                        <div class="px-6 py-4 flex flex-col text-sm font-normal items-center text-center w-full text-gray-500 dark:text-gray-400">
                            {{ __('No content available') }}
                        </div>
                    @endforelse
                </ul>
            @empty
                <div class="px-6 py-4 flex flex-col text-sm font-normal items-center text-center w-full text-gray-500 dark:text-gray-400">
                    {{ __('No content available') }}
                </div>
            @endforelse
            <div class="mx-3">
                <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'approve-modal')" class="w-full px-3 py-2 mt-6 text-sm font-medium flex justify-center items-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-800 dark:focus:ring-green-800">
                    <svg class="w-4 h-4 text-white me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                        <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z"/>
                        <path d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Zm-2.359 10.707-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L7 12.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span>
                        {{ __('Approve Material') }}
                    </span>
                </button>
                <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'resubmit-modal')" class="w-full px-3 py-2 mt-3 text-sm font-medium flex justify-center items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-800 dark:focus:ring-red-800">
                    <svg class="w-4 h-4 text-white me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                        <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z"/>
                        <path d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Zm-2.359 10.707-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L7 12.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span>
                        {{ __('Return for Resubmission') }}
                    </span>
                </button>
            </div>
        </div>
    </div>
    {{-- Drawer Component End --}}

    <div class="bg-white p-6 rounded-lg">
        <nav class="flex mb-3" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li>
                    <div class="flex items-center">
                    <a href="{{ route('evaluator.evaluation_management') }}" class="text-xs lg:text-sm font-medium text-gray-500 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{ __('Material Evaluation') }}</a></a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                    <svg class="w-2 lg:w-3 h-2 lg:h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ml-1 font-semibold text-sm lg:text-lg text-gray-700 dark:text-gray-400">{{ __('Evaluate') }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="text-md my-6 font-bold tracking-widest text-gray-900 md:text-2xl dark:text-white capitalize flex flex-col justify-center items-center w-full">
            {{ $instructionalMaterial->title }}
            <span class="text-sm text-gray-600 tracking-wide">{{ $instructionalMaterial->department->department_name . ', ' . $instructionalMaterial->campus->campus_name . ' Campus' }}</span>
        </div>
        <div class="px-0 sm:px-6 flex gap-6 flex-wrap">
            <div>
                <h3 class="text-md text-center mb-1 sm:text-start font-bold leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white capitalize">
                    {{ __('Instructional Material Details') }}
                </h3>
                <div class="px-2">
                    <div class="text-sm mb-4 font-normal text-gray-600 capitalize flex flex-wrap items-end justify-between">
                        <div class="mt-3 flex flex-wrap">
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
                    </div>
                    <p class="text-sm mb-2 font-normal text-gray-600 leading-6 tracking-wider">
                        {{ __('The instructional material, entitled "') }}<strong>{{ $instructionalMaterial->title }}</strong>{{ __('," stands as a meticulously crafted learning resource tailored for the ') }}<strong>{{ $instructionalMaterial->course->course_name }}</strong>{{ __(' program within the ') }}<strong>{{ $instructionalMaterial->department->department_name }}</strong>{{ __('. Its submission on ') }}<strong>{{ date('F d, Y', strtotime($instructionalMaterial->created_at)) }}</strong>{{ __(', by the esteemed uploader, "') }}<strong>{{ $instructionalMaterial->user->firstname . ' ' . $instructionalMaterial->user->lastname }}</strong>{{ __('," marks a significant contribution to the academic landscape. The development of this instructional material was spearheaded by a team of accomplished individuals, whose collective expertise and dedication are reflected in its content and structure. The collaboration of these professionals, comprising the talented minds listed in the random order of names, underscores the commitment to creating a comprehensive and impactful educational resource for the benefit of students pursuing excellence in the field.') }}
                    </p>
                </div>
            </div>
            <div class="hidden w-full sm:block mb-4">
                <h3 class="text-md mb-3 font-bold leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white capitalize">
                    {{ __('PDF Viewer') }}
                </h3>
                <iframe class="px-2" src="{{ asset($instructionalMaterial->pdf_path) }}" width="100%" height="1200px" frameborder="0"></iframe>
            </div>
        </div>
    </div>
    
    @section('scripts')
        <script src="{{ asset('js/evaluate.js') }}"></script>
    @endsection
</x-app-layout>