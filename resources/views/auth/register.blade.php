<x-guest-layout>
    <div class="w-full lg:w-1/2 mt-6 px-3 lg:px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">        
        <div class="p-6 space-y-4 md:space-y-6 sm:p-4">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                Set Up Your Account
            </h1>
            <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('register') }}">
                @csrf
    
                <h1 class="text-md font-bold leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white">
                    Account Details
                </h1>
    
                <div>
                    <div class="grid grid-cols-6 gap-2">
                        <div class="col-span-2">
                            <input type="text" name="firstname" id="firstname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Given Name') }}" required autofocus value="{{ old('firstname') }}">
                        </div>
                        <div class="col-span-2">
                            <input type="text" name="lastname" id="lastname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Family Name') }}" required value="{{ old('lastname') }}">
                        </div>
                        <div class="col-span-2">
                            <input type="text" name="middlename" id="middlename" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Middle Initial') }}" value="{{ old('middlename') }}">
                        </div>
                    </div>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">{{ __('You may choose to include your middle initial, but it is not required.') }}</p>
                    <x-input-error :messages="$errors->get('lastname')" class="mt-1" />
                    <x-input-error :messages="$errors->get('firstname')" class="mt-1" />
                </div>
    
                <div>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Enter your email address') }}" required value="{{ old('email') }}">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">{{ __('Rest assured, your email will remain confidential and won\'t be shared with anyone.') }}</p>
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>
    
                <div>
                    <input type="password" name="password" id="password" placeholder="{{ __('Enter your password') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">{{ __('Your password must be at least 8 characters long.') }}</p>
                </div>
    
                <div>
                    <input type="password" name="password_confirmation" id="confirm-password" placeholder="{{ __('Confirm password') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                
                <div class="flex items-start ms-1" style="margin-top: 6px !important;">
                    <div class="flex items-center h-5">
                        <input id="show_password" aria-describedby="show_password" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="show_password" class="text-gray-500 dark:text-gray-300">{{ __('Show passwords') }}</label>
                    </div>
                </div>
                
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
    
                <h1 class="text-md font-bold leading-tight tracking-tight text-gray-900 md:text-lg dark:text-white">
                    University Details
                </h1>
                <p class="text-sm text-start text-gray-500 dark:text-gray-300" id="file_input_help" style="margin-top: 12px !important;"><span class="text-sm font-bold">{{ __('Caution: ') }}</span>{{ __('Accurate university details are crucial for verification by the admin. Failure to provide correct information may result in account suspension.') }}</p>
    
                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('University Role') }}</label>
                    <div class="flex items-start">
                        <select name="university_role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" required>
                            <option value="" selected>Select University Role</option>
                            @foreach($universityRoles as $universityRole)
                                <option value="{{ $universityRole->id }}">{{ $universityRole->university_role }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <x-input-error :messages="$errors->get('university_role')" class="mt-1" />

                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">{{ __('Campus') }}</label>
                    <div class="flex items-start">
                        <select name="campus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-10 overflow-y-auto" required>
                            <option value="" selected>Select Campus</option>
                            @foreach($campuses as $campus)
                                <option value="{{ $campus->id }}">{{ $campus->campus_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <x-input-error :messages="$errors->get('campus')" class="mt-1" />
    
                <div class="flex items-start pt-3 ms-1" style="margin-top: 12px !important;">
                    <div class="flex items-center h-5">
                        <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required>
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="terms" class="font-light text-gray-500 dark:text-gray-300">{{ __('I accept the') }} <a class="font-medium text-blue-600 hover:underline dark:text-blue-500" href="#">{{ __('Terms and Conditions') }}</a></label>
                    </div>
                </div>
    
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button>
                        {{ __('Create Account') }}
                    </x-primary-button>
                </div>
    
                <div class="text-center">
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Already have an account? <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-500">{{ __('Log In') }}</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    @section('scripts')
        <script src="{{ asset('js/show-password.js') }}"></script>
    @endsection
</x-guest-layout>
