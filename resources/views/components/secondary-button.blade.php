<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-6 py-3 bg-white border border-gray-300 rounded-lg font-semibold text-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#14213d] focus:ring-offset-2 disabled:opacity-25 transition-all duration-300 shadow-md hover:shadow-lg']) }}>
    {{ $slot }}
</button>
