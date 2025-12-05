@props(['icon', 'title', 'value', 'color' => 'text-primary'])

<div class="stat bg-base-100 shadow-sm rounded-lg">
    <div class="stat-figure {{ $color }}">
        @if (isset($icon))
            <div class="shrink-0">
                {{ $icon }}
            </div>
        @endif
    </div>
    <div class="stat-title">{{ $title }}</div>
    <div class="stat-value {{ $color }}">{{ $value }}</div>
</div>
