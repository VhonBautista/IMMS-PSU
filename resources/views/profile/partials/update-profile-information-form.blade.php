<section>
    <header>
        <h1 class="text-md font-bold leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white">
            {{ __('Update Profile Information') }}
        </h1>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="firstname" :value="__('Name')" />
            <div class="grid grid-cols-6 mt-2 gap-2">
                <div class="col-span-2">
                    <input type="text" name="firstname" id="firstname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Firstname') }}" required value="{{ old('firstname', $user->firstname) }}">
                </div>
                <div class="col-span-2">
                    <input type="text" name="lastname" id="lastname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Lastname') }}" required value="{{ old('lastname', $user->lastname) }}">
                </div>
                <div class="col-span-2">
                    <input type="text" name="middlename" id="middlename" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Middle Initial') }}" value="{{ old('middlename', $user->middlename) }}">
                </div>
            </div>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">{{ __('You may choose to include your middle initial, but it is not required.') }}</p>
            <x-input-error :messages="$errors->get('firstname')" class="mt-1" />
            <x-input-error :messages="$errors->get('lastname')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-2" placeholder="{{ __('Enter your email') }}" required value="{{ old('email', $user->email) }}">
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="sm:w-44">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
