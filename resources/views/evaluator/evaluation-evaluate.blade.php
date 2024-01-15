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

    {{-- Evaluate Modal --}}
    <x-modal name="evaluate-modal" focusable>
        <div class="p-6">
            <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                {{ __('Evaluate Material') }}
            </h3>

            <form class="space-y-4 md:space-y-6 w-full" method="POST" action="{{ route('evaluator.evaluation_management.store') }}" id="evaluation-form">
                @csrf
                
                <input type="hidden" name="status" id="status" value="">
                <input type="hidden" id="passed-criteria" name="passed_criteria" value="">
                
                <input type="hidden" name="matrix_id" value="{{ $matrix->id }}">
                <input type="hidden" name="material_id" value="{{ $instructionalMaterial->id }}">

                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Passed Criteria') }}</label>
                    <p class="w-full text-gray-900 text-sm pt-1 px-2.5">
                        <span id="display-passed-criteria"></span>
                    </p>
                </div>

                <div class="w-full">
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Remarks') }}</label>
                    <textarea rows="4" name="comment" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Provide additional comments regarding this instructional material." required></textarea>
                    <x-input-error :messages="$errors->get('comment')" class="mt-1" />
                </div>
                        
                <div class="mt-5 pt-5 flex justify-between lg:justify-end">
                    <button class="hidden ms-3 sm:w-44w-full px-4 py-2 font-semibold capitalize text-xs text-center rounded-md tracking-widest text-white bg-red-600 border border-transparent hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" type='button' id="failed-btn">
                        {{ __('Return for Resubmission') }}
                    </button>

                    <button class="hidden ms-3 sm:w-44 w-full px-4 py-2 font-semibold capitalize text-xs text-center rounded-md tracking-widest text-white dark:text-gray-800 bg-gray-800 dark:bg-gray-200 border border-transparent hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" type='button' id="passed-btn">
                        {{ __('Submit Evaluation') }}
                    </button>
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
                            <div class="flex w-full justify-between items-center text-sm mb-1 pe-2">
                                <div class="flex items-center gap-1">
                                    <span class="text-gray-600 font-normal dark:text-gray-500" data-tooltip-placement="bottom" data-tooltip-target="tooltip-text-{{ $matrix->id . '-' . $subMatrix->id . '-' . $matrixItem->id }}" aria-hidden="true">{{ $matrixItem->item . ' (' . $matrixItem->score . '%)' }}</span>
                                </div>
                            </div>

                            <input type="number" min="0" max="{{ $matrixItem->score }}" id="input-{{ $matrix->id . '-' . $subMatrix->id . '-' . $matrixItem->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="0">

                            <div id="tooltip-text-{{ $matrix->id . '-' . $subMatrix->id . '-' . $matrixItem->id }}" role="tooltip"
                                class="absolute z-10 max-w-[300px] invisible inline-block px-3 py-2 text-sm font-normal text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                {{ $matrixItem->text }}
                            </div>
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
                <button type="button" id="open-evalutaion-modal-button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'evaluate-modal')" class="w-full px-3 py-2 mt-6 text-sm font-medium flex justify-center items-center text-white bg-gray-800 rounded-lg hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                    <svg class="w-4 h-4 text-white me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                        <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z"/>
                        <path d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Zm-2.359 10.707-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L7 12.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span>
                        {{ __('Evaluate Material') }}
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
                    {{ __('File Viewer') }}
                </h3>
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
    
    @section('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var nestedArray = [];

                @foreach ($matrix->subMatrices as $subMatrix)
                    var subMatrixData = {
                        title: "{{ $subMatrix->title }}",
                        matrixItems: [
                            @foreach($subMatrix->matrixItems->sortBy('item') as $matrixItem)
                                {
                                    item: "{{ $matrixItem->item }}",
                                    score: {{ $matrixItem->score }},
                                    value: 0,
                                    inputId: "input-{{ $matrix->id . '-' . $subMatrix->id . '-' . $matrixItem->id }}"
                                },
                            @endforeach
                        ]
                    };

                    nestedArray.push(subMatrixData);
                @endforeach

                // Function to update values from input fields
                function updateValues() {
                    nestedArray.forEach(function(subMatrixData) {
                        subMatrixData.matrixItems.forEach(function(matrixItem) {
                            matrixItem.value = document.getElementById(matrixItem.inputId).value;
                        });
                    });
                }

                // Generate and display the unordered list
                function displayList() {
                    updateValues();

                    var displayContainer = document.getElementById("display-passed-criteria");
                    displayContainer.innerHTML = '';
                    var hiddenInput = document.getElementById("passed-criteria");

                    nestedArray.forEach(function(subMatrixData) {
                        var subMatrixTitleDiv = document.createElement("div");
                        subMatrixTitleDiv.classList.add("mb-2", "text-md", "font-medium", "text-gray-800", "dark:text-white");
                        
                        var totalScore = subMatrixData.matrixItems.reduce(function (acc, matrixItem) {
                            return acc + matrixItem.score;
                        }, 0);

                        var totalValue = subMatrixData.matrixItems.reduce(function (acc, matrixItem) {
                            return acc + parseInt(matrixItem.value, 10);
                        }, 0);

                        subMatrixTitleDiv.textContent = subMatrixData.title;

                        var ul = document.createElement("ul");
                        ul.classList.add("max-w-md", "space-y-1", "list-disc", "list-inside");

                        subMatrixData.matrixItems.forEach(function(matrixItem) {
                            var li = document.createElement("li");
                            li.classList.add("font-normal", "text-gray-600");
                            li.textContent = matrixItem.item + ' (' + matrixItem.score + '%) : Score ' + matrixItem.value + '%';
                            ul.appendChild(li);
                        });

                        subMatrixTitleDiv.appendChild(ul);
                        displayContainer.appendChild(subMatrixTitleDiv);
                    });

                    // Calculate the average of total scores
                    var totalScores = nestedArray.map(function(subMatrixData) {
                        return subMatrixData.matrixItems.reduce(function(acc, matrixItem) {
                            return acc + parseInt(matrixItem.value, 10);
                        }, 0);
                    });

                    var averageTotalScore = totalScores.reduce(function(acc, totalScore) {
                        return acc + totalScore;
                    }, 0) / totalScores.length;

                    // Hide or show buttons based on the average total score
                    var failedBtn = document.getElementById("failed-btn");
                    var passedBtn = document.getElementById("passed-btn");

                    if (averageTotalScore > 75) {
                        failedBtn.classList.add("hidden");
                        passedBtn.classList.remove("hidden");
                    } else {
                        failedBtn.classList.remove("hidden");
                        passedBtn.classList.add("hidden");
                    }
                    var averageScoreParagraph = document.createElement("p");
                    averageScoreParagraph.classList.add("font-medium", "text-md", "text-gray-800", "dark:text-white");
                    averageScoreParagraph.textContent = "Average Score: " + averageTotalScore + "%";
                    displayContainer.appendChild(averageScoreParagraph);
                    
                    hiddenInput.value = displayContainer.innerHTML;
                }

                // Event listener for "Open Evaluation Modal" button
                document.getElementById("open-evalutaion-modal-button").addEventListener('click', function() {
                    updateValues();
                    displayList();
                });

                // Event listener for "Submit Evaluation" button
                document.getElementById("passed-btn").addEventListener('click', function() {
                    document.getElementById("status").value = "passed";
                    displayList();
                    document.getElementById("evaluation-form").submit();
                });

                // Event listener to the "Return for Resubmission" button
                document.getElementById("failed-btn").addEventListener('click', function() {
                    document.getElementById("status").value = "failed";
                    displayList();
                    document.getElementById("evaluation-form").submit();
                });
                
                displayList();
            });
        </script>
    @endsection
</x-app-layout>
