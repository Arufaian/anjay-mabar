<x-app-layout>
    <x-slot name="header">
        <div class="card bg-base-100 shadow-sm mt-4">
            <div class="card-body">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="card-title text-2xl">Analysis Results</h2>
                        <p class="text-base-content/70 mt-1">
                            Best motorcycles for your budget:
                            Rp {{ number_format($budget['budget_min'], 0, ',', '.') }} -
                            Rp {{ number_format($budget['budget_max'], 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="flex gap-2">
                        <a class="btn btn-primary btn-sm" href="{{ route('user.moora.create') }}">
                            <x-lucide-refresh-cw class="w-4 h-4 mr-1" />
                            New Analysis
                        </a>
                        <a class="btn btn-ghost btn-sm" href="{{ route('user.dashboard') }}">
                            <x-lucide-arrow-left class="w-4 h-4 mr-1" />
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    @if ($results['success'])
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 px-4 sm:px-6 lg:px-8">
            <!-- Best Alternative -->
            <div class="card bg-linear-to-br from-success to-success/80 text-success-content">
                <div class="card-body p-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 rounded-lg bg-success-content/20">
                            <x-lucide-trophy class="w-6 h-6" />
                        </div>
                        <div>
                            <p class="text-sm font-medium opacity-90">Best Choice</p>
                            <p class="text-lg font-bold">
                                {{ $results['data']['best_alternative']['alternative']['name'] }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Budget Range -->
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body p-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 rounded-lg bg-primary/10">
                            <x-lucide-wallet class="w-6 h-6 text-primary" />
                        </div>
                        <div>
                            <p class="text-sm font-medium text-base-content/70">Your Budget</p>
                            <p class="text-lg font-bold">
                                Rp {{ number_format($budget['budget_min'], 0, ',', '.') }} -
                                {{ number_format($budget['budget_max'], 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Available Options -->
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body p-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 rounded-lg bg-info/10">
                            <x-lucide-motorbike class="w-6 h-6 text-info" />
                        </div>
                        <div>
                            <p class="text-sm font-medium text-base-content/70">Available Options</p>
                            <p class="text-lg font-bold">{{ $results['data']['total_alternatives'] }} Motorcycles</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Results Table -->
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-lg mb-4">
                        <x-lucide-trophy class="w-5 h-5 mr-2" />
                        Recommended Motorcycles
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Motorcycle</th>
                                    <th>Model</th>
                                    <th>Type</th>
                                    <th>Score</th>
                                    <th>Price</th>
                                    <th>Recommendation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results['data']['ranked_alternatives'] as $index => $item)
                                    @php
                                        $priceValue =
                                            $item['alternative']
                                                ->alternativeValues()
                                                ->whereHas('criteria', fn($q) => $q->where('code', 'C1'))
                                                ->first()->value ?? 0;
                                    @endphp
                                    <tr class="{{ $index === 0 ? 'bg-success/10' : '' }}">
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
                                        <td>{{ $item['alternative']['model'] }}</td>
                                        <td>
                                            <span class="badge badge-outline badge-sm">
                                                {{ $item['alternative']['type'] }}
                                            </span>
                                        </td>
                                        <td class="font-mono font-bold">
                                            {{ number_format($item['score'], 4) }}
                                        </td>
                                        <td class="font-mono">
                                            Rp {{ number_format($priceValue, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            @if ($index === 0)
                                                <span class="badge badge-success badge-sm">Best Choice</span>
                                            @elseif ($index <= 2)
                                                <span class="badge badge-info badge-sm">Recommended</span>
                                            @else
                                                <span class="badge badge-ghost badge-sm">Alternative</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body text-center py-12">
                <x-lucide-search-x class="w-16 h-16 mx-auto mb-4 text-base-content/30" />
                <h3 class="text-lg font-medium mb-2">No Motorcycles Found</h3>
                <p class="text-base-content/60 mb-4">{{ $results['error'] }}</p>
                <a class="btn btn-primary" href="{{ route('user.moora.create') }}">
                    <x-lucide-arrow-left class="w-4 h-4 mr-1" />
                    Try Different Budget
                </a>
            </div>
        </div>
    @endif
</x-app-layout>
