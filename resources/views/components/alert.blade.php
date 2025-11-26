@php
    $base = "alert alert-$type";

    $titleClasses = 'font-medium';
    $messageClasses = 'text-sm opacity-80';
@endphp

<div {{ $attributes->merge(['class' => $base]) }}>
    {{-- Icon slot (optional). User may pass <x-lucide-* /> --}}

    <div class="flex flex-col">
        <div class="flex flex-row gap-2 mb-2">

            @if (isset($icon))
                <div class="shrink-0">
                    {{ $icon }}
                </div>
            @endif
            @if ($title)
                <div class="{{ $titleClasses }}">{{ $title }}</div>
            @endif

        </div>

        @if ($message)
            <div class="{{ $messageClasses }}">{{ $message }}</div>
        @endif

        {{-- Additional content slot --}}
        {{ $slot }}
    </div>
</div>
