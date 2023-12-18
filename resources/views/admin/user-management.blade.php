<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>
    <div class="bg-white p-4 rounded-lg ">
        <form action="{{ route('user_management') }}" method="GET" id="user-form" class="flex flex-col md:flex-row md:justify-between justify-center">
            <label for="search-user" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    
            <div class="flex w-full flex-wrap">
                <div class="w-full lg:w-auto px-1 pb-3 lg:pb-0">
                    <select name="campus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" required onchange="submitForm()">
                      <option value="" @if(!request('campus')) selected @endif>Select Campus</option>
                      @foreach($campuses as $campus)
                        <option value="{{ $campus->id }}" @if(request('campus') == $campus->id) selected @endif>{{ $campus->campus_name }}</option>
                      @endforeach
                    </select>
                </div>

                <div class="w-full lg:w-auto px-1 pb-3 lg:pb-0">
                    <select name="university_role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" required onchange="submitForm()">
                        <option value="" @if(!request('university_role')) selected @endif>Select University Role</option>
                        @foreach($universityRoles as $role)
                            <option value="{{ $role->id }}" @if(request('university_role') == $role->id) selected @endif>{{ $role->university_role }}</option>
                        @endforeach
                    </select>
                </div>
            </div>                   
    
            <div class="relative w-full md:w-3/4">
                <input type="search" id="search-user" name="search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border-r-gray-50 border-r-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-r-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search users" value="{{ request('search') }}">
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
                                {{ __('User') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('User Type') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('University Role') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Campus') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Date Joined') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">{{ __('Actions') }}</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">{{ $user->lastname . ', ' . $user->firstname . ' ' . $user->middlename }}</div>
                                    <div class="font-medium text-xs text-gray-500">{{ $user->email }}</div>
                                </th>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium mr-2 px-2.5 py-0.5 rounded-full 
                                        @if ($user->role->id == 1 || $user->role->id == 2)
                                            bg-blue-100 text-blue-800  dark:bg-blue-900 dark:text-blue-300
                                        @elseif ($user->role->id == 3)
                                            bg-violet-100 text-violet-800 dark:bg-violet-700 dark:text-violet-300
                                        @else
                                            bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-300
                                        @endif
                                    ">{{ $user->role->role_name }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $user->universityRole->university_role }}
                                </td>
                                <td class="px-6 py-4 capitalize">
                                    {{ $user->campus->campus_name }}
                                </td>
                                <td class="px-6 py-4 capitalize">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button type="button" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg class="w-4 h-4 text-white transition duration-75 group-hover:text-blue-700 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M18 7.5h-.423l-.452-1.09.3-.3a1.5 1.5 0 0 0 0-2.121L16.01 2.575a1.5 1.5 0 0 0-2.121 0l-.3.3-1.089-.452V2A1.5 1.5 0 0 0 11 .5H9A1.5 1.5 0 0 0 7.5 2v.423l-1.09.452-.3-.3a1.5 1.5 0 0 0-2.121 0L2.576 3.99a1.5 1.5 0 0 0 0 2.121l.3.3L2.423 7.5H2A1.5 1.5 0 0 0 .5 9v2A1.5 1.5 0 0 0 2 12.5h.423l.452 1.09-.3.3a1.5 1.5 0 0 0 0 2.121l1.415 1.413a1.5 1.5 0 0 0 2.121 0l.3-.3 1.09.452V18A1.5 1.5 0 0 0 9 19.5h2a1.5 1.5 0 0 0 1.5-1.5v-.423l1.09-.452.3.3a1.5 1.5 0 0 0 2.121 0l1.415-1.414a1.5 1.5 0 0 0 0-2.121l-.3-.3.452-1.09H18a1.5 1.5 0 0 0 1.5-1.5V9A1.5 1.5 0 0 0 18 7.5Zm-8 6a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7Z"/>
                                        </svg>
                                        <span class="ml-1 uppercase">{{ __('Manage') }}</span>
                                    </button>
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
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>