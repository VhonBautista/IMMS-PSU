<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Course Colleges') }}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto mt-8">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6">Edit College and Course</h2>

            <form action="{{ route('course_colleges.update', $coursecollege->id) }}" method="POST">
                @csrf
                @method('PUT')
            
                {{-- College ID --}}
                <div class="mb-4">
                    <label for="collegeId" class="block text-gray-700 text-sm font-bold mb-2">College ID:</label>
                    <select id="collegeId" name="collegeId" class="border rounded-md w-full py-2 px-3">
                        @foreach($colleges as $college)
                            <option value="{{ $college->id }}" {{ $coursecollege->college_id == $college->id ? 'selected' : '' }}>
                                {{ $college->id }}
                            </option>
                        @endforeach
                    </select>
                </div>
            
                {{-- Course ID --}}
                <div class="mb-4">
                    <label for="courseId" class="block text-gray-700 text-sm font-bold mb-2">Course ID:</label>
                    <select id="courseId" name="courseId" class="border rounded-md w-full py-2 px-3">
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ $coursecollege->course_id == $course->id ? 'selected' : '' }}>
                                {{ $course->id }}
                            </option>
                        @endforeach
                    </select>
                </div>
            
             
            
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Update
                </button>
            </form>
            
        </div>
    </div>


</x-app-layout>