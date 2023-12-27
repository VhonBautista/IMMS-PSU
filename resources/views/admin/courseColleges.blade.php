<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex justify-between items-center">
            {{ __('Course_Colleges') }}
            <button style="margin-left: 160%;" onclick="showAddCourseModal()" class="px-3 py-2 text-xs font-small text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                  </svg>                  
                <span class="ml-1 uppercase">{{ __('Add') }}</span>
            </button>
            
            
        </h2>
        <style>
    /* Styles for the modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 15%;
    right: 0%;
    top: 0;
    width: 90%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* Close button styles */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}
.close:hover {
    color: black;
}

        </style>
<div id="addCourseModal" class="modal hidden fixed inset-0 z-50 overflow-auto bg-gray-800 bg-opacity-75 flex justify-center items-center">
    <div class="modal-content bg-white p-6 rounded-md relative">
        
        <button onclick="hideAddCourseModal()" class="absolute top-4 right-4 text-gray-700 cursor-pointer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

   
        <h2 class="text-xl font-bold mb-4">Add Course</h2>
        <form id="addCourseForm" action='{{ route("course_colleges.store") }}' method="POST" class="space-y-4">
            @csrf 
            
            <div class="mb-4">
                <label for="collegeId" class="block text-gray-700 text-sm font-bold mb-2">College:</label>
                <select id="collegeId" name="collegeId" class="border rounded-md w-full py-2 px-3">
                   
                    @foreach($colleges as $college)
                        <option value="{{ $college->id }}">{{ $college->id }}</option>
                    @endforeach
                </select>
            </div>
        
            <div class="mb-4">
                <label for="courseId" class="block text-gray-700 text-sm font-bold mb-2">Course:</label>
                <select id="courseId" name="courseId" class="border rounded-md w-full py-2 px-3">
                    
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->id }}</option>
                    @endforeach
                </select>
            </div>
        
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Submit
            </button>
        </form>
    </div>
</div>


{{-- delete --}}

<div id="deleteConfirmationModal" class="modal hidden fixed inset-0 z-50 overflow-auto bg-gray-800 bg-opacity-75 flex justify-center items-center">
    <div class="modal-content bg-white p-6 rounded-md relative">
        <p class="text-lg font-semibold mb-4">Are you sure you want to delete this item?</p>
        <div class="flex space-x-4">
            <button onclick="confirmDelete()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Yes, Delete
            </button>
            <button onclick="hideDeleteConfirmation()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Cancel
            </button>
        </div>
    </div>
</div>

    </x-slot>
   
    </div>
    <div class="max-w-7xl mt-3 mx-auto space-y-6">
        <div class="relative overflow-x-auto border sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            {{ __('College ID') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Course ID') }}
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
                    @forelse( $coursecollege as $coursecollege)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">{{ $coursecollege->college_id }}</div>
                            </th>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $coursecollege->course_id }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $coursecollege->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 capitalize">
                                {{ $coursecollege->updated_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex space-x-2">
                                    <form action="{{ route('course_colleges.edit', $coursecollege->id) }}" method="GET">
                                        @csrf
                                        <button type="submit" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                              </svg>                                                  
                                            <span class="ml-1 uppercase">{{ __('Edit') }}</span>
                                        </button>
                                    </form>


                                    <form id="deleteForm" method="POST" >
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="showDeleteConfirmation('{{ route('course_colleges.delete', $coursecollege->id) }}')" class="px-3 py-2 text-xs font-small text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                            <span class="ml-1 uppercase">{{ __('Delete') }}</span>
                                        </button>
                                    </form>
                                   

                                    
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
      function showAddCourseModal() {
        var modal = document.getElementById('addCourseModal');

        modal.style.display = 'block';
    }

    function hideAddCourseModal() {
        var modal = document.getElementById('addCourseModal');
        modal.style.display = 'none';
    }

    function submitAddCourseForm() {
        
        var form = document.getElementById('addCourseForm');

       
        form.submit();

      
        location.reload();
    }
    
</script>


{{-- delete --}}
<script>
    function showDeleteConfirmation(deleteUrl) {
        // Show the delete confirmation modal
        var modal = document.getElementById('deleteConfirmationModal');
        modal.style.display = 'block';

        // Set the delete URL
        document.getElementById('deleteForm').action = deleteUrl;
        console.log("pressed button delete");
    }

    function confirmDelete() {
       
        document.getElementById('deleteForm').onsubmit = function () {
          
            var modal = document.getElementById('deleteConfirmationModal');
            modal.style.display = 'none';

           
            window.reload();
        };

       
        document.getElementById('deleteForm').submit();
    }

    function hideDeleteConfirmation() {
       
        var modal = document.getElementById('deleteConfirmationModal');
        modal.style.display = 'none';
    }
</script>


</x-app-layout>