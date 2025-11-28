@php
    // DaisyUI classes
    $base = 'badge';

    $colorClass = $outlined ? "badge-outline badge-{$color}" : "badge-{$color}";

    $sizeClass = match ($size) {
        'xs' => 'badge-xs',
        'sm' => 'badge-sm',
        'lg' => 'badge-lg',
        default => 'badge-md',
    };

    $classes = "{$base} {$colorClass} {$sizeClass}";
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
