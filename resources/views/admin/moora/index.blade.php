<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-4">
        <!-- Header Section -->
        <x-slot name="header">
            <div class="card bg-base-100 shadow-sm mt-4">
                <div class="card-body">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="card-title text-2xl">MOORA Analysis Results</h2>
                            <p class="text-base-content/70 mt-1">Complete multi-objective decision analysis results</p>
                        </div>
                        <div class="flex gap-2">
                            <form method="POST" action="{{ route('admin.moora.calculate') }}" class="inline">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm" @if(!$validation['valid']) disabled @endif>
                                    <x-lucide-calculator class="w-4 h-4 mr-1" />
                                    Recalculate
                                </button>
                            </form>
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

        <!-- Weight Validation Issues -->
        @if (!$validation['valid'])
            <div class="alert alert-warning mb-4">
                <x-lucide-alert-triangle class="w-6 h-6" />
                <div>
                    <h3 class="font-bold">Weight Configuration Issues</h3>
                    <div class="text-sm">
                        @foreach ($validation['issues'] as $issue)
                            <p>{{ $issue }}</p>
                        @endforeach
                        <p class="mt-2">Current total weight: {{ number_format($validation['total_weight'], 4) }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if ($calculationSummary['success'])
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Best Alternative -->
                <div class="card bg-linear-to-br from-success to-success/80 text-success-content">
                    <div class="card-body p-4">
                        <div class="flex items-center gap-3">
                            <div class="p-2 rounded-lg bg-success-content/20">
                                <x-lucide-trophy class="w-6 h-6" />
                            </div>
                            <div>
                                <p class="text-sm font-medium opacity-90">Best Alternative</p>
                                <p class="text-lg font-bold">
                                    {{ $calculationSummary['data']['best_alternative']['alternative']['name'] ?? 'N/A' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Alternatives -->
                <x-stats-card 
                    value="{{ $calculationSummary['data']['total_alternatives'] }}" 
                    title="Total Alternatives" 
                    subtitle=" motorcycle options" 
                    :icon="'motorbike'" 
                    color="info" 
                    route="alternative" />

                <!-- Total Criteria -->
                <x-stats-card 
                    value="{{ $calculationSummary['data']['total_criteria'] }}" 
                    title="Total Criteria" 
                    subtitle=" decision factors" 
                    :icon="'list-checks'" 
                    color="warning" 
                    route="criteria" />

                <!-- Total Weight -->
                <x-stats-card 
                    value="{{ number_format($validation['total_weight'], 3) }}" 
                    title="Total Weight" 
                    subtitle="should equal 1.000" 
                    :icon="'scale'" 
                    color="accent" 
                    route="weights" />
            </div>

            <!-- Final Rankings -->
            <div class="card bg-base-100 shadow-sm mb-6">
                <div class="card-body">
                    <h3 class="card-title text-lg mb-4">
                        <x-lucide-file-chart-line class="w-5 h-5 mr-2" />
                        Final Rankings
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Alternative</th>
                                    <th>Code</th>
                                    <th>Model</th>
                                    <th>Score</th>
                                    <th>Performance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($calculationSummary['data']['calculation_details']['ranked_alternatives'] as $index => $item)
                                    <tr>
                                        <td>
                                            @if ($index === 0)
                                                <span class="badge badge-warning">🥇 {{ $item['rank'] }}</span>
                                            @elseif ($index === 1)
                                                <span class="badge badge-neutral">🥈 {{ $item['rank'] }}</span>
                                            @elseif ($index === 2)
                                                <span class="badge badge-ghost">🥉 {{ $item['rank'] }}</span>
                                            @else
                                                <span class="badge badge-outline">{{ $item['rank'] }}</span>
                                            @endif
                                        </td>
                                        <td class="font-medium">{{ $item['alternative']['name'] }}</td>
                                        <td>{{ $item['alternative']['code'] }}</td>
                                        <td>{{ $item['alternative']['model'] }}</td>
                                        <td class="font-mono">
                                            {{ number_format($item['score'], 4) }}
                                        </td>
                                        <td>
                                            <div class="flex items-center gap-2">
                                                <div class="w-full max-w-xs">
                                                    <progress 
                                                        class="progress progress-success" 
                                                        value="{{ max(0, min(100, ($item['score'] + 1) * 50)) }}" 
                                                        max="100">
                                                    </progress>
                                                </div>
                                                <span class="text-sm text-base-content/60">
                                                    {{ round(max(0, min(100, ($item['score'] + 1) * 50))) }}%
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Calculation Details Accordion -->
            <div class="card bg-base-100 shadow-sm mb-6">
                <div class="card-body">
                    <h3 class="card-title text-lg mb-4">
                        <x-lucide-settings class="w-5 h-5 mr-2" />
                        Calculation Details
                    </h3>
                    
                    <div class="collapse collapse-arrow bg-base-200 mb-3">
                        <input type="checkbox" id="decisionMatrix" />
                        <div class="collapse-title text-lg font-medium">
                            <x-lucide-grid-3x3 class="w-5 h-5 inline mr-2" />
                            Decision Matrix
                        </div>
                        <div class="collapse-content">
                            <div class="overflow-x-auto mt-4">
                                <table class="table table-sm table-zebra">
                                    <thead>
                                        <tr>
                                            <th>Alternative</th>
                                            @foreach ($calculationSummary['data']['calculation_details']['criteria'] as $criterion)
                                                <th>{{ $criterion['name'] }}
                                                    <small class="block text-xs text-base-content/60">
                                                        {{ $criterion['type'] }}
                                                    </small>
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($calculationSummary['data']['calculation_details']['alternatives'] as $alternative)
                                            <tr>
                                                <td class="font-medium">{{ $alternative['name'] }}</td>
                                                @foreach ($calculationSummary['data']['calculation_details']['criteria'] as $criterion)
                                                    <td class="font-mono text-sm">
                                                        {{ number_format($calculationSummary['data']['calculation_details']['decision_matrix'][$alternative['id']][$criterion['id']] ?? 0, 2) }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="collapse collapse-arrow bg-base-200 mb-3">
                        <input type="checkbox" id="normalizedMatrix" />
                        <div class="collapse-title text-lg font-medium">
                            <x-lucide-percent class="w-5 h-5 inline mr-2" />
                            Normalized Matrix
                        </div>
                        <div class="collapse-content">
                            <div class="overflow-x-auto mt-4">
                                <table class="table table-sm table-zebra">
                                    <thead>
                                        <tr>
                                            <th>Alternative</th>
                                            @foreach ($calculationSummary['data']['calculation_details']['criteria'] as $criterion)
                                                <th>{{ $criterion['name'] }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($calculationSummary['data']['calculation_details']['alternatives'] as $alternative)
                                            <tr>
                                                <td class="font-medium">{{ $alternative['name'] }}</td>
                                                @foreach ($calculationSummary['data']['calculation_details']['criteria'] as $criterion)
                                                    <td class="font-mono text-sm">
                                                        {{ number_format($calculationSummary['data']['calculation_details']['normalized_matrix'][$alternative['id']][$criterion['id']] ?? 0, 4) }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="collapse collapse-arrow bg-base-200 mb-3">
                        <input type="checkbox" id="weightedMatrix" />
                        <div class="collapse-title text-lg font-medium">
                            <x-lucide-sliders class="w-5 h-5 inline mr-2" />
                            Weighted Matrix
                        </div>
                        <div class="collapse-content">
                            <div class="overflow-x-auto mt-4">
                                <table class="table table-sm table-zebra">
                                    <thead>
                                        <tr>
                                            <th>Alternative</th>
                                            @foreach ($calculationSummary['data']['calculation_details']['criteria'] as $criterion)
                                                <th>{{ $criterion['name'] }}
                                                    <small class="block text-xs text-base-content/60">
                                                        w={{ number_format($criterion['weight']['weight'] ?? 0, 3) }}
                                                    </small>
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($calculationSummary['data']['calculation_details']['alternatives'] as $alternative)
                                            <tr>
                                                <td class="font-medium">{{ $alternative['name'] }}</td>
                                                @foreach ($calculationSummary['data']['calculation_details']['criteria'] as $criterion)
                                                    <td class="font-mono text-sm">
                                                        {{ number_format($calculationSummary['data']['calculation_details']['weighted_matrix'][$alternative['id']][$criterion['id']] ?? 0, 4) }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="collapse collapse-arrow bg-base-200">
                        <input type="checkbox" id="finalScores" />
                        <div class="collapse-title text-lg font-medium">
                            <x-lucide-trending-up class="w-5 h-5 inline mr-2" />
                            Final Scores
                        </div>
                        <div class="collapse-content">
                            <div class="overflow-x-auto mt-4">
                                <table class="table table-sm table-zebra">
                                    <thead>
                                        <tr>
                                            <th>Alternative</th>
                                            <th>Benefit Sum</th>
                                            <th>Cost Sum</th>
                                            <th>Final Score</th>
                                            <th>Formula</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($calculationSummary['data']['calculation_details']['ranked_alternatives'] as $item)
                                            <tr>
                                                <td class="font-medium">{{ $item['alternative']['name'] }}</td>
                                                <td class="font-mono text-sm text-success">
                                                    {{ number_format($item['score'] > 0 ? $item['score'] : 0, 4) }}
                                                </td>
                                                <td class="font-mono text-sm text-error">
                                                    {{ number_format($item['score'] < 0 ? abs($item['score']) : 0, 4) }}
                                                </td>
                                                <td class="font-mono text-sm font-bold">
                                                    {{ number_format($item['score'], 4) }}
                                                </td>
                                                <td class="text-xs text-base-content/60">
                                                    Σ(benefit) - Σ(cost)
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- No Data Available -->
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body text-center py-12">
                    <x-lucide-calculator class="w-16 h-16 mx-auto mb-4 text-base-content/30" />
                    <h3 class="text-lg font-medium mb-2">No Calculation Results Available</h3>
                    <p class="text-base-content/60 mb-4">{{ $calculationSummary['error'] }}</p>
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('admin.alternative.index') }}" class="btn btn-primary btn-sm">
                            <x-lucide-plus class="w-4 h-4 mr-1" />
                            Add Alternatives
                        </a>
                        <a href="{{ route('admin.criteria.index') }}" class="btn btn-secondary btn-sm">
                            <x-lucide-plus class="w-4 h-4 mr-1" />
                            Add Criteria
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>