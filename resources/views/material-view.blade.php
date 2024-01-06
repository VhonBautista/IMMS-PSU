<x-app-layout>
    @section('links')
        <li class="me-1">
            <a href="{{ route('home') }}" class="inline-block p-5 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">{{ __('Instructional Materials') }}</a>
        </li>
        <li class="me-1">
            <a href="{{ route('submission_management') }}" class="inline-block p-5 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500" aria-current="page">{{ __('Submissions') }}</a>
        </li>
    @endsection   

    @section('burger_links')
        <x-responsive-nav-link :href="route('home')">
            {{ __('Instructional Materials') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('submission_management')">
            {{ __('Submissions') }}
        </x-responsive-nav-link>
    @endsection   

    <div class="bg-white p-6 rounded-lg">
        <nav class="flex mb-3" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li>
                    <div class="flex items-center">
                    <a href="{{ route('submission_management') }}" class="text-xs lg:text-sm font-medium text-gray-500 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{ __('Submissions') }}</a></a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                    <svg class="w-2 lg:w-3 h-2 lg:h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ml-1 font-semibold text-sm lg:text-lg text-gray-700 dark:text-gray-400">{{ __('View') }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="text-md my-6 font-bold tracking-widest text-gray-900 md:text-2xl dark:text-white capitalize flex flex-col justify-center items-center w-full">
            {{ $instructionalMaterial->title }}
            <span class="text-sm text-gray-600 tracking-wide">{{ $instructionalMaterial->department->department_name . ', ' . $instructionalMaterial->campus->campus_name . ' Campus' }}</span>
        </div>
        <div class="px-0 sm:px-6 flex gap-6 flex-wrap">
            <div>
                <h3 class="text-md text-center mb-2 sm:text-start font-bold leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white capitalize">
                    {{ __('Instructional Material Details') }}
                </h3>
                <div class="px-2">
                    <p class="text-sm mb-6 font-normal text-gray-600 leading-6 tracking-wider">
                        {{ __('The instructional material, entitled "') }}<strong>{{ $instructionalMaterial->title }}</strong>{{ __('," stands as a meticulously crafted learning resource tailored for the ') }}<strong>{{ $instructionalMaterial->course->course_name }}</strong>{{ __(' program within the ') }}<strong>{{ $instructionalMaterial->department->department_name }}</strong>{{ __('. Its submission on ') }}<strong>{{ date('F d, Y', strtotime($instructionalMaterial->created_at)) }}</strong>{{ __(', by the esteemed uploader, "') }}<strong>{{ $instructionalMaterial->user->firstname . ' ' . $instructionalMaterial->user->lastname }}</strong>{{ __('," marks a significant contribution to the academic landscape. The development of this instructional material was spearheaded by a team of accomplished individuals, whose collective expertise and dedication are reflected in its content and structure. The collaboration of these professionals, comprising the talented minds listed in the random order of names, underscores the commitment to creating a comprehensive and impactful educational resource for the benefit of students pursuing excellence in the field.') }}
                    </p>
                    <div class="text-sm mb-2 font-normal text-gray-600 capitalize flex items-center justify-between">
                        <div>
                            <strong>{{ __('Proponents: ') }}</strong>{{ $instructionalMaterial->proponents }} |  <strong>{{ __('Material Type: ') }}</strong>{{ $instructionalMaterial->type }}
                        </div>
                        <div>
                            <span class="block text-sm text-center font-medium mr-2 px-2.5 py-1 rounded bg-blue-100 text-blue-800  dark:bg-blue-900 dark:text-blue-300">
                                {{ $instructionalMaterial->status }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden w-full sm:block">
                <h3 class="text-md mb-3 font-bold leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white capitalize">
                    {{ __('PDF Viewer') }}
                </h3>
                <iframe class="px-2" src="{{ asset($instructionalMaterial->pdf_path) }}" width="100%" height="1200px" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</x-app-layout>