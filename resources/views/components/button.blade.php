<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-sksu-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sksu-700 focus:bg-sksu-700 active:bg-sksu-900 focus:outline-none focus:ring-2 focus:ring-sksu-700 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
