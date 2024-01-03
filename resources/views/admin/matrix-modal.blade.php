<div class="relative overflow-x-auto border sm:rounded-lg" style="height: 20rem">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">{{ __('Actions') }}</span>
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('University Evaluator') }}
                </th>
                <th scope="col" class="px-6 py-3 hidden md:block">
                    {{ __('Description') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($universityRoles as $universityRole)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" name="univ_role_ids[]" value="{{ $universityRole->id }}" class="form-checkbox h-4 w-4 text-blue-600 dark:text-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-600">
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">{{ $universityRole->university_role }}</div>
                    </th>
                    <td class="px-6 py-4 hidden md:block">
                        {{ $universityRole->description }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>