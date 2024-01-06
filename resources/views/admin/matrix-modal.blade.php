<div class="relative overflow-x-auto border sm:rounded-lg" style="height: 20rem">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">{{ __('Actions') }}</span>
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Evaluator') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Role') }}
                </th>
                <th scope="col" class="px-6 py-3 hidden md:block">
                    {{ __('Campus') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($evaluators as $evaluator)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" name="evaluator_ids[]" value="{{ $evaluator->id }}" class="form-checkbox h-4 w-4 text-blue-600 dark:text-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-600">
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">{{ $evaluator->lastname . ', ' . $evaluator->firstname . ' ' . $evaluator->middlename }}</div>
                        <div class="font-medium text-xs text-gray-500">{{ $evaluator->email }}</div>
                        <div class="font-medium text-xs text-gray-500">{{ $evaluator->universityRole->university_role }}</div>
                    </th>
                    <td class="px-6 py-4">
                        <span class="block text-sm text-center font-medium mr-2 px-2.5 py-1 rounded 
                            @if ($evaluator->role->id == 1 || $evaluator->role->id == 2)
                                bg-blue-100 text-blue-800  dark:bg-blue-900 dark:text-blue-300
                            @elseif ($evaluator->role->id == 3)
                                bg-violet-100 text-violet-800 dark:bg-violet-700 dark:text-violet-300
                            @else
                                bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-300
                            @endif
                        ">
                            {{ $evaluator->role->role_name }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="block text-sm text-start font-medium mr-2 py-1">
                            {{ $evaluator->campus->campus_name }} Campus
                        </span>
                    </td>
                </tr>
            @empty
                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td colspan="4" class="px-6 py-4 text-center">
                        <div class="p-4 text-sm">
                            {{ __('There are no available evaluators') }}
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>