<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex justify-between items-center">
            {{ __('Course') }}
            <button style="margin-left: 145%;" onclick="showAddCourseModal()" class="px-3 py-2 text-xs font-small text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                  </svg>                  
                <span class="ml-1 uppercase">{{ __('Add') }}</span>
            </button>
            
            
        </h2>
    </x-slot>
    
    @if(session('success'))
    <div class="bg-green-200 border-green-500 border-l-4 p-4 mb-4">
        <p class="text-green-700">{{ session('success') }}</p>
    </div>
    @endif
    

    <div class="bg-white p-4 rounded-lg ">
        <form action="" method="GET" id="user-form" class="flex flex-col md:flex-row md:justify-between justify-center">
            <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search Course</label>


            <div class="relative w-full md:w-3/4">
            </div>


            <div class="relative w-full md:w-2/6">
                <input type="search" id="search-user" name="search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border-r-gray-50 border-r-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-r-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search Course" value="{{ request('search') }}">
                <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-gray-800 rounded-r-lg border border-gray-800 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>

            
        </form>

        <script>
            function submitForm() {
                document.getElementById('user-form').submit();
            }
        </script>

        <div class="max-w-7xl mt-3 mx-auto space-y-6">
            <div class="relative overflow-x-auto border sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Course Name') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Campus Name') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Created At') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Updated At') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">{{ __('Actions') }}</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse( $courses as $course)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">{{ $course->course_name }}</div>
                                </th>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $course->campus_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $course->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 capitalize">
                                    {{ $course->updated_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex space-x-2">
                                        <form action="{{ route('admin.course-management.edit', ['id' => $course->id]) }}" method="GET">
                                            @csrf
                                            <button type="submit" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                  </svg>                                                  
                                                <span class="ml-1 uppercase">{{ __('Edit') }}</span>
                                            </button>
                                        </form>

                                        <button type="button" class="px-3 py-2 text-xs font-small text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" onclick="showDeleteModal({{ $course->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                              </svg>                                              
                                            <span class="ml-1 uppercase">{{ __('Delete') }}</span>
                                        </button>

                                        
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">{{ __('No courses found.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

            <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="fixed inset-0 overflow-y-auto hidden">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- Modal Content -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">

                                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 3a9.01 9.01 0 1 1 13.878 0h0"></path>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                                    Delete Confirmation
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-300">
                                        Are you sure you want to delete this course? This action cannot be undone.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <form action="{{ route('admin.course-management.destroy', ['id' => ':courseId']) }}" method="POST" id="deleteForm">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-700 text-base font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Delete
                            </button>
                        </form>
                        <button type="button" onclick="hideDeleteModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function showDeleteModal(courseId) {
                document.getElementById('deleteForm').action = '{{ route("admin.course-management.destroy", [":courseId"]) }}'.replace(':courseId', courseId);
                document.getElementById('deleteModal').classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            function hideDeleteModal() {
                document.getElementById('deleteModal').classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        </script>



        <!-- Add Course Modal -->
        <div id="addCourseModal" class="fixed inset-0 z-50 overflow-auto bg-smoke-dark flex hidden">
            <div class="relative p-8 bg-white shadow rounded w-full max-w-2xl mx-auto mt-20 max-h-50 overflow-y-auto">
                <!-- Close Button -->
                <div class="absolute top-0 right-0">
                    <button onclick="hideAddCourseModal()" class="text-gray-700 hover:text-gray-600">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Content -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ __('Add Course') }}</h3>
                    <form action="{{ route('admin.course-management.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="new_course_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Course Name</label>
                            <input type="text" id="new_course_name" name="new_course_name" class="mt-1 p-2 w-full border rounded-md dark:bg-gray-800 dark:border-gray-700">
                        </div>
                        <div class="mb-4">
                            <label for="new_campus_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Campus</label>
                            <select id="new_campus_id" name="new_campus_id" class="mt-1 p-2 w-full border rounded-md dark:bg-gray-800 dark:border-gray-700">
                                @foreach($campuses as $campusId => $campusName)
                                    <option value="{{ $campusId }}">{{ $campusName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="px-3 py-2 text-xs font-small text-center inline-flex items-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            <span class="ml-1 uppercase">{{ __('Add Course') }}</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function showAddCourseModal() {
                document.getElementById('addCourseModal').classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            function hideAddCourseModal() {
                document.getElementById('addCourseModal').classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        </script>


</x-app-layout>
