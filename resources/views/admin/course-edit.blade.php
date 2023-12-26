<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Course') }}
        </h2>
    </x-slot>

    <div class="bg-white p-4 rounded-lg">
        <form action="{{ route('admin.course-management.update', $course->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="course_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Course Name</label>
                <input type="text" id="course_name" name="course_name" value="{{ old('course_name', $course->course_name) }}" class="mt-1 p-2 w-full border rounded-md dark:bg-gray-800 dark:border-gray-700">
            </div>

            <div class="mb-4">
                <label for="campus_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Campus</label>
                <select id="campus_id" name="campus_id" class="mt-1 p-2 w-full border rounded-md dark:bg-gray-800 dark:border-gray-700">
                    @foreach($campuses as $campusId => $campusName)
                        <option value="{{ $campusId }}" {{ $course->campus_id == $campusId ? 'selected' : '' }}>{{ $campusName }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-between">

                <a href="{{ route('admin.course_management') }}" class="px-3 py-2 text-xs font-small text-center inline-flex items-center text-white bg-gray-500 rounded-lg hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    <span class="ml-1 uppercase">{{ __('Cancel') }}</span>
                </a>

                <button type="submit" class="px-3 py-2 text-xs font-small text-center inline-flex items-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    <span class="ml-1 uppercase">{{ __('Update') }}</span>
                </button>

                
            </div>
        </form>
    </div>
    
</x-app-layout>
