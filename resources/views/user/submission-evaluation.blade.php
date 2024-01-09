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
                    <span class="ml-1 font-semibold text-sm lg:text-lg text-gray-700 dark:text-gray-400">{{ __('Resubmit') }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="bg-white p-6 rounded-lg">
            <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                {{ __('Manage Material & Resubmit') }}
            </h3>
            <span class="text-xs font-medium text-gray-600">{{ __('Please carefully review each field and ensure that all inputs are accurate. Once submitted, you can view the form details, but editing will only be possible after the evaluators return it to you.') }}</span>

            <form class="space-y-4 md:space-y-6 mx-3 mb-12 px-12 pb-8 pt-2 border rounded-lg mt-3 shadow" method="POST" action="{{ route('submission_management.resubmit') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
    
                <input type="hidden" name="material_id" value="{{ $instructionalMaterial->id }}">    

                <div class="w-full">
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Material Title') }}</label>
                    <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 capitalize" placeholder="{{ __('Enter the title of the instructional material') }}" required value="{{ old('title', $instructionalMaterial->title) }}">
                    <x-input-error :messages="$errors->get('title')" class="mt-1" />
                </div>

                <div class="grid grid-cols-6 gap-5">
                    <div class="col-span-3">
                        <div class="w-full">
                            <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Material Type') }}</label>
                            <select name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" required>
                                <option value="course_book" @if($instructionalMaterial->type == 'course_book') selected @endif>{{ __('Course Book') }}</option>
                                <option value="textbook" @if($instructionalMaterial->type == 'textbook') selected @endif>{{ __('Textbook') }}</option>
                                <option value="modules" @if($instructionalMaterial->type == 'modules') selected @endif>{{ __('Modules') }}</option>
                                <option value="laboratory_manual" @if($instructionalMaterial->type == 'laboratory_manual') selected @endif>{{ __('Laboratory Manual') }}</option>
                                <option value="prototype" @if($instructionalMaterial->type == 'prototype') selected @endif>{{ __('Prototype') }}</option>
                                <option value="others" @if($instructionalMaterial->type == 'others') selected @endif>{{ __('Others') }}</option>
                            </select>
                        </div>
                        <x-input-error :messages="$errors->get('type')" class="mt-1" />
                    </div>
                    
                    <div class="col-span-3">
                        <div class="w-full">
                            <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Campus') }}</label>
                            <select name="campus_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" required>
                                @foreach($campuses as $campus)
                                    <option value="{{ $campus->id }}" @if($instructionalMaterial->campus_id == $campus->id) selected @endif>{{  $campus->campus_name . ' Campus' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-input-error :messages="$errors->get('campus_id')" class="mt-1" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Target Course') }}</label>
                    <select name="course_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" required>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" @if($instructionalMaterial->course_id == $course->id) selected @endif>{{  $course->campus->campus_name . ' - ' . $course->course_name }}</option>
                        @endforeach
                    </select>
                </div>
                <x-input-error :messages="$errors->get('course_id')" class="mt-1" />
                    
                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Department') }}</label>
                    <select name="department_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" required>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" @if($instructionalMaterial->department_id == $department->id) selected @endif>{{  $department->campus->campus_name . ' - ' . $department->department_name }}</option>
                        @endforeach
                    </select>
                </div>
                <x-input-error :messages="$errors->get('department_id')" class="mt-1" />

                <div class="w-full">
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Proponents') }}</label>
                    <textarea rows="6" name="proponents" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 capitalize" placeholder="Enter the names of the proponents for the instructional material, separated by commas." required>{{ old('proponents', $instructionalMaterial->proponents) }}</textarea>
                    <x-input-error :messages="$errors->get('proponents')" class="mt-1" />
                </div>
                
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-900 dark:text-white">{{ __('Update Instructional Material PDF') }}</label>
                    <span class="block text-xs font-medium text-gray-600">{{ __('Take note that uploading a new file will replace the existing version with the updated one.') }} <a href="{{ asset($instructionalMaterial->pdf_path) }}" target="_blank" class="text-blue-600">Click here to view current PDF</a></span>
                    
                    <input class="block w-full mt-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" name="pdf_path" type="file" accept=".pdf" required>
                    <span class="text-xs font-medium text-gray-600">{{ __('Kindly submit your instructional material in PDF format, ensuring that the file size does not exceed 50 megabytes (MB).') }}</span>
                    <x-input-error :messages="$errors->get('pdf_path')" class="mt-1" />
                </div>

                <div class="mt-5 pt-5 flex justify-between lg:justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')" class="sm:w-44">
                        {{ __('Cancel') }}
                    </x-secondary-button>
                    <x-primary-button class="ms-3 sm:w-44" type='submit'>
                        {{ __('Resubmit') }}
                    </x-primary-button>
                </div>
            </form>

            <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                {{ __('Evaluation History') }}
            </h3>     
            <div class="max-w-7xl mt-3 mx-3 shadow rounded-lg mx-auto space-y-6">
                <div class="relative overflow-x-auto border sm:rounded-lg">
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
                                        <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">
                                            {{ __('Matrix Details:') }}
                                        </div>
                                        <p class="font-medium text-xs text-gray-500 capitalize">
                                            {{ $evaluation->matrix->matrix_name . ' (' . $evaluation->matrix->level . ' Level)'  }}
                                        </p>
                                        <div class="font-medium text-sm mt-2 text-gray-800 dark:text-gray-200 capitalize">
                                            {{ __('Passed Criteria:') }}
                                        </div>
                                        <p class="font-medium text-xs text-gray-500 capitalize">
                                            {{ $evaluation->passed_criteria }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="font-medium text-xs text-gray-500">
                                            {{ $evaluation->comment }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 capitalize">
                                        {{ $evaluation->created_at->format('M d, Y') }}
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

    @section('scripts')
    <script>
        document.querySelector('select[name="campus_id"]').addEventListener('change', function () {
            var campusId = this.value;
            let urlCourses = "{{ route('fetch_courses', [':campusId']) }}".replace(':campusId', campusId);
            let urlDepartments = "{{ route('fetch_departments', [':campusId']) }}".replace(':campusId', campusId);

            fetch(urlCourses)
                .then(response => response.json())
                .then(data => {
                    var courseDropdown = document.querySelector('select[name="course_id"]');
                    courseDropdown.innerHTML = '<option selected disabled>Select Target Course</option>';
                    
                    data.courses.forEach(course => {
                        courseDropdown.innerHTML += '<option value="' + course.id + '">' + course.course_name + '</option>';
                    });
                })
                .catch(error => console.error('Error fetching courses:', error));
    

            fetch(urlDepartments)
                .then(response => response.json())
                .then(data => {
                    var departmentDropdown = document.querySelector('select[name="department_id"]');
                    departmentDropdown.innerHTML = '<option selected disabled>Select Department</option>';
                    
                    data.departments.forEach(department => {
                        departmentDropdown.innerHTML += '<option value="' + department.id + '">' + department.department_name + '</option>';
                    });
                })
                .catch(error => console.error('Error fetching departments:', error));
        });
    </script>
    @endsection
</x-app-layout>