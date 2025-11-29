<div class="toast toast-end z-50" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">

    @if (isset($alert))
        {{ $alert }}
    @else
        {{ $slot }}
    @endif
</div>
