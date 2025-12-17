<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-4">
        <!-- Header Section -->
        <x-slot name="header">
            <div class="card bg-base-100 shadow-sm mt-4">
                <div class="card-body">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="card-title text-2xl">Alternative Details</h2>
                            <p class="text-base-content/70 mt-1">View detailed information about {{ $alternative->name }}
                            </p>
                        </div>

                        <div class="flex gap-2">
                            <a class="btn btn-ghost btn-sm" href="{{ route('admin.alternative.index') }}">
                                <x-lucide-arrow-left class="w-4 h-4 mr-1" />
                                Back to List
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </x-slot>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-2">
            <!-- Left Column - Main Info -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Alternative Card -->
                <div class="card bg-base-100 shadow-sm">
                    <figure class="overflow-hidden ">
                        <img class="aspect-video w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                            src="https://picsum.photos/seed/motorcycle-{{ $alternative->code }}/800/400.jpg"
                            alt="{{ $alternative->name }}" />
                    </figure>
                    <div class="card-body">
                        <div class="flex items-start justify-between">
                            <div>
                                <h2 class="card-title text-2xl">{{ $alternative->name }}</h2>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    @switch($alternative->type)
                                        @case('matic')
                                            <x-badge color="primary" size="sm">Matic</x-badge>
                                        @break

                                        @case('maxi series')
                                            <x-badge color="warning" size="sm">Maxi Series</x-badge>
                                        @break

                                        @case('classy')
                                            <x-badge color="info" size="sm">Classy</x-badge>
                                        @break

                                        @case('sport')
                                            <x-badge color="error" size="sm">Sport</x-badge>
                                        @break

                                        @case('offroad')
                                            <x-badge color="success" size="sm">Offroad</x-badge>
                                        @break

                                        @case('moped')
                                            <x-badge color="neutral" size="sm">Moped</x-badge>
                                        @break

                                        @default
                                            <x-badge color="ghost" size="sm">{{ ucfirst($alternative->type) }}</x-badge>
                                    @endswitch

                                    <x-badge color="secondary" size="sm">{{ $alternative->code }}</x-badge>

                                    @if ($alternative->year)
                                        <x-badge color="outline" size="sm">{{ $alternative->year }}</x-badge>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="divider"></div>

                        <div class="space-y-3">
                            @if ($alternative->model)
                                <div class="flex items-center gap-3">
                                    <x-lucide-settings class="w-5 h-5 text-base-content/60" />
                                    <div>
                                        <div class="text-sm text-base-content/60">Model</div>
                                        <div class="font-medium">{{ $alternative->model }}</div>
                                    </div>
                                </div>
                            @endif

                            @if ($alternative->year)
                                <div class="flex items-center gap-3">
                                    <x-lucide-calendar class="w-5 h-5 text-base-content/60" />
                                    <div>
                                        <div class="text-sm text-base-content/60">Year</div>
                                        <div class="font-medium">{{ $alternative->year }}</div>
                                    </div>
                                </div>
                            @endif

                            @if ($alternative->description)
                                <div class="flex items-start gap-3">
                                    <x-lucide-file-text class="w-5 h-5 text-base-content/60 mt-0.5" />
                                    <div>
                                        <div class="text-sm text-base-content/60">Description</div>
                                        <div class="font-medium">{{ $alternative->description }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Criteria Values Section -->
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold">Criteria Values</h3>
                            <div class="text-sm text-base-content/60">
                                {{ $alternative->alternativeValues->count() }} / {{ $criteriaCount }} criteria
                            </div>
                        </div>

                        @if ($alternative->alternativeValues->isNotEmpty())
                            <div class="space-y-3">
                                @foreach ($alternative->alternativeValues as $value)
                                    <div class="card bg-base-200 border border-base-300">
                                        <div class="card-body p-4">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center">
                                                        <x-lucide-target class="w-6 h-6 text-primary" />
                                                    </div>
                                                    <div>
                                                        <h4 class="font-semibold">{{ $value->criteria->name }}</h4>
                                                        <div
                                                            class="flex items-center gap-2 text-sm text-base-content/60">
                                                            <span>{{ $value->criteria->code }}</span>
                                                            @if ($value->criteria->type)
                                                                <span>•</span>
                                                                <span>{{ $value->criteria->type }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="text-right">
                                                    <div class="text-2xl font-bold text-primary">
                                                        {{ number_format($value->value, $value->value == floor($value->value) ? 0 : 2) }}
                                                    </div>
                                                    @if ($value->criteria->unit)
                                                        <div class="text-sm text-base-content/60">
                                                            {{ $value->criteria->unit }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            @if ($value->notes)
                                                <div class="mt-3 p-3 bg-base-100 rounded-lg">
                                                    <div class="text-sm text-base-content/80">
                                                        <x-lucide-sticky-note class="w-4 h-4 inline mr-1" />
                                                        {{ $value->notes }}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <x-lucide-alert-triangle class="w-4 h-4" />
                                <span>No criteria values found for this alternative.</span>
                                <div class="flex-1"></div>
                                <button class="btn btn-warning btn-sm"
                                    onclick="modal_create_alternative_value.showModal()">
                                    <x-lucide-plus class="w-4 h-4 mr-1" />
                                    Add First Value
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column - Quick Access & Stats -->
            <div class="space-y-6">
                <!-- Quick Access Card -->
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-lg">Quick Access</h3>

                        <div class="space-y-2">
                            <a class="btn btn-ghost btn-sm w-full justify-start"
                                href="{{ route('admin.alternative.index') }}">
                                <x-lucide-motorbike class="w-4 h-4 mr-2" />
                                All Alternatives
                            </a>

                            <a class="btn btn-ghost btn-sm w-full justify-start"
                                href="{{ route('admin.criteria.index') }}">
                                <x-lucide-list class="w-4 h-4 mr-2" />
                                Manage Criteria
                            </a>

                            <button class="btn btn-ghost btn-sm w-full justify-start"
                                onclick="modal_create_alternative_value.showModal()">
                                <x-lucide-plus-circle class="w-4 h-4 mr-2" />
                                Add Alternative Value
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Alternative Value Modal (Placeholder) -->
        <dialog class="modal" id="modal_create_alternative_value">
            <div class="modal-box">
                <h3 class="font-bold text-lg mb-4">Add Alternative Value</h3>
                <p class="py-4">This modal will be implemented for adding alternative values.</p>
                <div class="modal-action">
                    <form method="dialog">
                        <button class="btn">Close</button>
                    </form>
                </div>
            </div>
            <form class="modal-backdrop" method="dialog">
                <button>close</button>
            </form>
        </dialog>
    </div>
</x-app-layout>
