<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-[#14213d] border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-[#0f1a2e] focus:bg-[#0f1a2e] active:bg-[#0a1423] focus:outline-none focus:ring-2 focus:ring-[#14213d] focus:ring-offset-2 transition-all duration-300 shadow-md hover:shadow-lg']) }}>
    {{ $slot }}
</button>
