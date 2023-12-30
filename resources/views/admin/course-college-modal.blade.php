<div class="relative overflow-x-auto border sm:rounded-lg" style="height: 20rem">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">{{ __('Actions') }}</span>
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Course Name') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Campus') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" name="course_ids[]" value="{{ $course->id }}" class="form-checkbox h-4 w-4 text-blue-600 dark:text-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-600">
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">{{ $course->course_name }}</div>
                    </th>
                    <td class="px-6 py-4">
                        {{ $course->campus->campus_name }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>