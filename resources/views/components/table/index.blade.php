<table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-gray-200']) }}>
    {{-- create slot for header --}}
    @if(isset($head))
        <thead>
            {{ $head }}
        </thead>
    @endif
    {{-- create slot for body --}}
    @if(isset($body))
        <tbody>
            {{ $body }}
        </tbody>
    @endif
</table>
