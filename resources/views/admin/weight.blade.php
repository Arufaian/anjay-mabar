<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-4">
        <!-- Header Section -->
        <x-slot name="header">
            <div class="card bg-base-100 shadow-sm mt-4">
                <div class="card-body">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="card-title text-2xl">Weight Management</h2>
                            <p class="text-base-content/70 mt-1">Configure criteria weights for decision analysis</p>
                        </div>
                        <div class="flex gap-2">
                            <a class="btn btn-ghost btn-sm" href="{{ route('admin.dashboard') }}">
                                <x-lucide-arrow-left class="w-4 h-4 mr-1" />
                                Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>

        @if (session('success'))
            <x-toast>
                <x-alert type="success" :message="session('success')" :title="__('success')">
                    <x-slot name="icon">
                        <x-lucide-check-circle class="w-6 h-6" />
                    </x-slot>
                </x-alert>
            </x-toast>
        @endif

        @if (session('error'))
            <x-toast>
                <x-alert type="error" :message="session('error')" :title="__('error')">
                    <x-slot name="icon">
                        <x-lucide-x-circle class="w-6 h-6" />
                    </x-slot>
                </x-alert>
            </x-toast>
        @endif

        <!-- Weight Form -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Form -->
            <div class="lg:col-span-2">
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-lg mb-4">Weight Configuration</h3>

                        <form class="space-y-6" method="POST" action="{{ route('admin.weights.update') }}"
                            x-data="{ loading: false }" @submit="loading = true">
                            @csrf
                            @method('PUT')

                            <!-- Weight Inputs -->
                            <div class="space-y-4">
                                <h4 class="font-semibold text-base-content/80 flex items-center gap-2">
                                    <x-lucide-sliders class="w-4 h-4" />
                                    Criteria Weights
                                </h4>

                                <div class="space-y-6">
                                    @foreach ($criteria as $criterion)
                                        <div class="shadow border border-primary/30 rounded-lg p-4 space-y-3">
                                            <div class="flex justify-between items-start mb-4">
                                                <div>
                                                    <h5 class="font-semibold">{{ $criterion->name }}</h5>
                                                    <p class="text-sm text-base-content/70">Code: {{ $criterion->code }}
                                                    </p>
                                                </div>
                                                <x-badge
                                                    color="{{ $criterion->type === 'benefit' ? 'success' : 'error' }}"
                                                    size="sm">
                                                    {{ ucfirst($criterion->type) }}
                                                </x-badge>
                                            </div>

                                            <fieldset class="fieldset">
                                                <legend class="fieldset-legend">Weight Value (0.00 - 1.00)</legend>
                                                <input class="input w-full" name="weights[{{ $criterion->id }}]"
                                                    type="number"
                                                    value="{{ $criterion->weight ? $criterion->weight->weight : 0 }}"
                                                    min="0" max="1" step="0.01" placeholder="0.00"
                                                    required />
                                                <p class="fieldset-label">bobot untuk kriteria {{ $criterion->name }}</p>
                                            </fieldset>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Total Validation Info -->
                            <div class="alert alert-info">
                                <x-lucide-info class="w-4 h-4" />
                                <div>
                                    <p class="text-sm font-medium">Important: Total weights must equal exactly 1.00</p>
                                    <p class="text-xs  mt-1">The system will validate that the sum
                                        of all weights equals 1.00 before saving.</p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-3 pt-6 ">
                                <button class="btn btn-primary w-full sm:w-auto" type="submit" :disabled="loading">
                                    <x-lucide-save class="w-4 h-4 mr-2" x-show="!loading" />
                                    <span class="loading loading-spinner loading-sm" x-show="loading"></span>
                                    <span x-text="loading ? 'Saving...' : 'Save Weights'"></span>
                                </button>
                                <a class="btn btn-ghost w-full sm:w-auto" href="{{ route('admin.dashboard') }}">
                                    <x-lucide-x class="w-4 h-4 mr-2" />
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Current Status Card -->
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-lg mb-4">Weight Summary</h3>

                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-base-content/70">Total Criteria</span>
                                <span class="text-sm font-medium">{{ $criteria->count() }}</span>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-sm text-base-content/70">Current Total</span>
                                <span class="text-sm font-medium">
                                    {{ number_format($criteria->sum(function ($c) {return $c->weight ? $c->weight->weight : 0;}),4) }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-sm text-base-content/70">Status</span>
                                <x-badge
                                    color="{{ $criteria->sum(function ($c) {return $c->weight ? $c->weight->weight : 0;}) == 1.0? 'success': 'warning' }}"
                                    size="sm">
                                    {{ $criteria->sum(function ($c) {return $c->weight ? $c->weight->weight : 0;}) == 1.0? 'Valid': 'Invalid' }}
                                </x-badge>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-lg mb-4">Quick Actions</h3>

                        <div class="space-y-2">
                            <a class="btn btn-ghost btn-sm w-full justify-start"
                                href="{{ route('admin.criteria.index') }}">
                                <x-lucide-list class="w-4 h-4 mr-2" />
                                Manage Criteria
                            </a>

                            <a class="btn btn-ghost btn-sm w-full justify-start" href="{{ route('admin.dashboard') }}">
                                <x-lucide-home class="w-4 h-4 mr-2" />
                                Dashboard
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Help Card -->
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-lg mb-4">Help</h3>

                        <div class="space-y-3 text-sm text-base-content/70">
                            <div class="flex items-start gap-2">
                                <x-lucide-check class="w-4 h-4 text-success mt-0.5 shrink-0" />
                                <p>Each weight must be between 0.00 and 1.00</p>
                            </div>
                            <div class="flex items-start gap-2">
                                <x-lucide-check class="w-4 h-4 text-success mt-0.5 shrink-0" />
                                <p>Total of all weights must equal exactly 1.00</p>
                            </div>
                            <div class="flex items-start gap-2">
                                <x-lucide-check class="w-4 h-4 text-success mt-0.5 shrink-0" />
                                <p>Higher weights indicate more important criteria</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- chart card --}}
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-lg mb-4">Pembagian bobot kriteria</h3>
                        <div style="height: 300px;">
                            <canvas id="weightChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Prepare chart data -->
    <script>
        window.weightChartLabels = <?php echo json_encode($chartLabels); ?>;
        window.weightChartData = <?php echo json_encode($chartData); ?>;
    </script>

    <!-- Load chart script -->
    <script src="{{ asset('js/weight-chart.js') }}"></script>
</x-app-layout>
