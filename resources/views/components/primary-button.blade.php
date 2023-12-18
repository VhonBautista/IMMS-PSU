<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full px-4 py-2 font-semibold capitalize text-xs text-center rounded-md tracking-widest text-white dark:text-gray-800 bg-gray-800 dark:bg-gray-200 border border-transparent hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
