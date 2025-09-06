<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-6 py-3 bg-yellow-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-yellow-500 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition-all duration-300 shadow-md hover:shadow-lg']) }}>
    {{ $slot }}
</button>