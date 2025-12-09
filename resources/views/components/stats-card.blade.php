<div
    class="card group bg-base-100 shadow-md border border-base-200 hover:shadow-lg hover:-translate-y-2 hover:ring hover:ring-{{ $color }}/50 transition duration-300">
    <div class="card-body p-4 lg:p-6">

        <div class="flex items-center gap-4">
            {{-- Icon --}}

            <div class="p-3 rounded-lg bg-{{ $color }} text-base-100 shrink-0">
                <x-dynamic-component class="w-5 h-5 lg:w-6 lg:h-6" :component="'lucide-' . $icon" />

            </div>

            {{-- Content --}}
            <div class="flex-1 min-w-0">
                <h3 class="card-title text-sm lg:text-base font-semibold text-base-content">{{ $title }}
                </h3>
                <p class="text-xs lg:text-sm text-base-content/70 truncate">{{ $subtitle }}</p>

            </div>

            {{-- Value --}}
            <div class="text-right shrink-0">
                <p class="text-lg lg:text-2xl font-bold text-base-content">{{ $value }}</p>
            </div>
        </div>

        <a class="mt-4 flex items-center gap-2" href="{{ route('admin.' . $route . '.index') }}">
            <span class="group-hover:text-{{ $color }} hover:mr-3 transition duration-300">View more</span>
            <x-lucide-move-right class="w-4 h-4 lg:w-5 lg:h-5 text-base-content/70 group-hover:text-{{ $color }}" />
        </a>
    </div>
</div>
