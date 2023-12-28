<section>
    <header>
        <h1 class="text-md font-bold leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white">
            {{ __('Profile Information') }}
        </h1>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Here are your profile details.") }}
        </p>
    </header>

    <div class="mt-6 space-y-6">
        <div>
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ $user->firstname . ' ' . $user->lastname }}</div>
                <div class="font-medium text-sm text-gray-500">{{ $user->email }}</div>
                <div class="font-medium text-sm text-gray-500">{{ 'System ' . $user->role->role_name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ $user->universityRole->university_role . ' at ' . $user->campus->campus_name . ' Campus' }}</div>
            </div>
        </div>
    </div>
</section>
