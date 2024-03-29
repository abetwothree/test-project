<x-button
    {{ $attributes->merge([
        'type' => 'reset',
        'class' => 'inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 active:bg-red-700 focus:outline-none focus:border-red-900 focus:shadow-outline-red disabled:opacity-25 transition ease-in-out duration-150',
    ]) }}
>
    {{ $slot }}
</x-button>
