<x-guest-layout>
    <div class="w-full sm:max-w-md mt-6 px-3 lg:px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="p-6 space-y-4 md:space-y-6 sm:p-4">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                Log in to your account
            </h1>
            <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
                @csrf
    
                <div>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Enter your email') }}" required autofocus value="{{ old('email') }}">
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>
    
                <div>
                    <input type="password" name="password" id="password" placeholder="{{ __('Enter your password') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>
    
                <div class="flex items-center justify-between" style="margin-top: 6px !important;">
                    <div class="flex items-start ms-1">
                        <div class="flex items-center h-5">
                            <input id="show_password" aria-describedby="show_password" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="show_password" class="text-gray-500 dark:text-gray-300">{{ __('Show password') }}</label>
                        </div>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">{{ __('Forgot your password?') }}</a>
                    @endif
                </div>
    
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const passwordInput = document.getElementById('password');
                        const confirmPasswordInput = document.getElementById('confirm-password');
                        const showPasswordCheckbox = document.getElementById('show_password');
                
                        showPasswordCheckbox.addEventListener('change', function () {
                            const passwordType = showPasswordCheckbox.checked ? 'text' : 'password';
                            passwordInput.type = passwordType;
                            confirmPasswordInput.type = passwordType;
                        });
                    });
                </script>
    
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button>
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
                
                <div class="text-center">
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        {{ __('Don\'t have an account yet?') }} <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-500">{{ __('Create Account') }}</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
