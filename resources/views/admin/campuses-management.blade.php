<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Campus Management') }}
            </h2>
    
           
        </div>
    </x-slot>
    @if(session('success'))
    <div class="bg-green-200 border-green-500 border-l-4 p-4 mb-4">
        <p class="text-green-700">{{ session('success') }}</p>
    </div>
    @endif
    
    <div class="bg-white p-4 rounded-lg ">
        <form action="{{ route('campuses_management') }}" method="GET" id="user-form" class="flex flex-col md:flex-row md:justify-between justify-center">
            <label for="search Campus" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search Campus</label>
    

                              
    
            <div class="relative w-full md:w-3/4">
                <input type="search" id="search-user" name="search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border-r-gray-50 border-r-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-r-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search Campus" value="{{ request('search') }}">
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
                                {{ __('Campus Name') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Location') }}
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
                        @forelse( $campuses as $campus)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">{{ $campus->campus_name }}</div>
                                </th>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium mr-2 px-2.5 py-0.5 rounded-full">{{ $campus->location }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $campus->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 capitalize">
                                    {{ $campus->updated_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex space-x-2">
                                        <form action="{{ route('admin.campuses-management.edit', $campus->id) }}" method="GET">
                                            @csrf
                                            <button type="submit" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                  </svg>  
                                                <span class="ml-1 uppercase">{{ __('Edit') }}</span>
                                            </button>
                                        </form>
                                
                                        <form action="{{ route('campus.delete', $campus->id) }}" method="POST" id="deleteForm{{ $campus->id }}">
                                            @csrf
                                            @method('DELETE')
                                
                                            <button type="button" onclick="confirmDelete('{{ route('campus.delete', $campus->id) }}')" class="px-3 py-2 text-xs font-small text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
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
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">{{ __('No campuses found.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                    
                </table>
            </div>
            {{-- {{ $users->links() }} --}}
        </div>
    </div>
    <script>
        function confirmDelete(deleteUrl) {
            if (confirm("Are you sure you want to delete this item?")) {
                
                window.location.href = deleteUrl;
            }
        }
    </script>
</x-app-layout>