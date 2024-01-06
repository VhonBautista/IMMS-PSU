<x-app-layout>
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

    <div class="p-6">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
            {{ __('Submit a Instructional Material') }}
        </h3>
        <span class="text-xs font-medium text-gray-600">{{ __('Please carefully review each field and ensure that all inputs are accurate. Once submitted, you can view the form details, but editing will only be possible after the evaluators return it to you.') }}</span>

        <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('resubmission_management.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <input type="hidden" name="IM_id" value="{{ $ims->id }}">
            <div class="w-full">
                <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Material Title') }}</label>
                <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Enter the title of the instructional material') }}" required  value="{{ old('title', $ims->title) }}">
                <x-input-error :messages="$errors->get('title')" class="mt-1" />
            </div>

            <div class="grid grid-cols-6 gap-5">
                <div class="col-span-3">
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Material Type') }}</label>
                        <select name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" required>
                            <option value="" selected disabled>{{ __('Select Material Type') }}</option>
                            <option value="course_book" {{ $ims->type == 'course_book' ? 'selected' : '' }}>{{ __('Course Book') }}</option>
                            <option value="textbook" {{ $ims->type == 'textbook' ? 'selected' : '' }}>{{ __('Textbook') }}</option>
                            <option value="modules" {{ $ims->type == 'modules' ? 'selected' : '' }}>{{ __('Modules') }}</option>
                            <option value="laboratory manual" {{ $ims->type == 'laboratory manual' ? 'selected' : '' }}>{{ __('Laboratory Manual') }}</option>
                            <option value="prototype" {{ $ims->type == 'prototype' ? 'selected' : '' }}>{{ __('Prototype') }}</option>
                            <option value="others" {{ $ims->type == 'others' ? 'selected' : '' }}>{{ __('Others') }}</option>
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('type')" class="mt-1" />
                </div>
                
                <div class="col-span-3">
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Campus') }}</label>
                        <select name="campus_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" required>
                            <option selected disabled>{{ __('Select Campus') }}</option>
                         @foreach($campuses as $campus)
                         <option value="{{ $campus->id }}" {{ old('campus_id') == $campus->id ? 'selected' : '' }}>
                            {{ $campus->campus_name }}
                        </option>
                         @endforeach
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('campus_id')" class="mt-1" />
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Target Course') }}</label>
                <select name="course_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" required>
                    <option selected disabled>{{ __('Select Target Course') }}</option>
                    {{-- @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{  $course->campus->campus_name . ' - ' . $course->course_name }}</option>
                    @endforeach --}}
                </select>
            </div>
            <x-input-error :messages="$errors->get('course_id')" class="mt-1" />
                
            <div>
                <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Department') }}</label>
                <select name="department_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" required>
                    <option selected disabled>{{ __('Select Department') }}</option>
                    {{-- @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{  $department->campus->campus_name . ' - ' . $department->department_name }}</option>
                    @endforeach --}}
                </select>
            </div>
            <x-input-error :messages="$errors->get('department_id')" class="mt-1" />

            <div class="w-full">
                <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Proponents') }}</label>
                <textarea rows="6" name="proponents" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter the names of the proponents for the instructional material, separated by commas." required>{{ old('proponents', $ims->proponents) }}</textarea>
                <x-input-error :messages="$errors->get('proponents')" class="mt-1" />
            </div>
            
            <div class="w-full">
                @if ($ims->pdf_path)
                <p class="text-sm text-gray-900">{{ __('Current PDF: ') }} {{ pathinfo($ims->pdf_path, PATHINFO_FILENAME) }}</p>
                @endif
            
                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" name="pdf_path" type="file" accept=".pdf">
            
                {{-- Provide instructions and errors --}}
                <span class="text-xs font-medium text-gray-600">{{ __('Kindly submit your instructional material in PDF format, ensuring that the file size does not exceed 50 megabytes (MB).') }}</span>
                <x-input-error :messages="$errors->get('pdf_path')" class="mt-1" />
            </div>
            <div class="mt-5 pt-5 flex justify-between lg:justify-end">
                <x-primary-button class="sm:w-44" type='submit'>
                    {{ __('Submit') }}
                </x-primary-button>
                <a href="{{ route('submission_management') }}"><x-secondary-button  class="ms-3 sm:w-44">
                    {{ __('Cancel') }}
                </x-secondary-button></a>
            </div>
        </form>
    </div>

    <script>
        document.querySelector('select[name="campus_id"]').addEventListener('change', function () {
    var campusId = this.value;

    var courseDropdown = document.querySelector('select[name="course_id"]');
    var departmentDropdown = document.querySelector('select[name="department_id"]');

    // Disable dropdowns initially
    courseDropdown.setAttribute('disabled', 'disabled');
    departmentDropdown.setAttribute('disabled', 'disabled');

    fetch('/get-courses/' + campusId)
        .then(response => response.json())
        .then(data => {
            // Enable course dropdown and populate options
            courseDropdown.removeAttribute('disabled');
            courseDropdown.innerHTML = '<option selected disabled>Select Target Course</option>';
            
            data.courses.forEach(course => {
                courseDropdown.innerHTML += '<option value="' + course.id + '">' + course.course_name + '</option>';
            });
        })
        .catch(error => console.error('Error fetching courses:', error));

    fetch('/get-departments/' + campusId)
        .then(response => response.json())
        .then(data => {
            // Enable department dropdown and populate options
            departmentDropdown.removeAttribute('disabled');
            departmentDropdown.innerHTML = '<option selected disabled>Select Department</option>';
            
            data.departments.forEach(department => {
                departmentDropdown.innerHTML += '<option value="' + department.id + '">' + department.department_name + '</option>';
            });
        })
        .catch(error => console.error('Error fetching departments:', error));
});
    </script>

</x-app-layout>