<x-app-layout>

    <div class="px-4 sm:px-6 lg:px-8 py-4">
        <!-- Header Section -->
        <x-slot name="header">
            <div class="card bg-base-100 shadow-sm mt-4">
                <div class="card-body">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="card-title text-2xl">Alternative Values Management</h2>
                            <p class="text-base-content/70 mt-1">Manage criteria values for motorcycle alternatives</p>
                        </div>

                        <div class="flex gap-2">
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.alternative-value.create') }}">
                                <x-lucide-plus class="w-4 h-4 mr-1" />
                                Add Value
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

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

            <x-admin.stats-card :title="'total values'" :value="$alternativeValues->total()" color="text-primary">

                <x-slot name="icon">
                    <x-lucide-target class="w-8 h-8" />
                </x-slot>

            </x-admin.stats-card>

            <x-admin.stats-card :title="'unique alternatives'" :value="$alternativeValues->pluck('alternative_id')->unique()->count()" color="text-accent">

                <x-slot name="icon">
                    <x-lucide-motorbike class="w-8 h-8" />
                </x-slot>

            </x-admin.stats-card>

            <x-admin.stats-card :title="'unique criteria'" :value="$alternativeValues->pluck('criteria_id')->unique()->count()" color="text-warning">

                <x-slot name="icon">
                    <x-lucide-list class="w-8 h-8" />
                </x-slot>

            </x-admin.stats-card>

            <x-admin.stats-card :title="'completion rate'" :value="$alternatives->count() > 0
                ? round(($alternativeValues->count() / ($alternatives->count() * $criteria->count())) * 100, 1) . '%'
                : '0%'" color="text-info">

                <x-slot name="icon">
                    <x-lucide-check-circle class="w-8 h-8" />
                </x-slot>

            </x-admin.stats-card>

        </div>

        <!-- Table Section -->
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body p-0">

                {{-- Search & Filters --}}
                <div class="p-4 border-b border-base-200">
                    <form class="flex flex-col sm:flex-row gap-4" method="GET">

                        <div class="form-control flex-1">
                            <input class="input input-bordered input-sm w-full" name="search" type="text"
                                value="{{ request('search') }}"
                                placeholder="Search by value, notes, alternative, or criteria..." />
                        </div>

                        <div class="flex gap-2">
                            <select class="select select-bordered select-sm" name="alternative_id">
                                <option value="">All Alternatives</option>
                                @foreach ($alternatives as $alternative)
                                    <option value="{{ $alternative->id }}" @selected(request('alternative_id') == $alternative->id)>
                                        {{ $alternative->code }} - {{ $alternative->name }}</option>
                                @endforeach
                            </select>

                            <select class="select select-bordered select-sm" name="criteria_id">
                                <option value="">All Criteria</option>
                                @foreach ($criteria as $criterion)
                                    <option value="{{ $criterion->id }}" @selected(request('criteria_id') == $criterion->id)>
                                        {{ $criterion->code }} - {{ $criterion->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-primary btn-sm" type="submit">Filter</button>

                        @if (request()->hasAny(['search', 'alternative_id', 'criteria_id']))
                            <a class="btn btn-ghost btn-sm" href="{{ route('admin.alternative-value.index') }}">
                                <x-lucide-x class="w-4 h-4" />
                                Reset
                            </a>
                        @endif
                    </form>
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="table table-sm ">
                        <thead>
                            <tr class="bg-base-200">
                                <th class="w-12">
                                    <input class="checkbox checkbox-sm" type="checkbox" />
                                </th>
                                <th>Alternative</th>
                                <th>Criteria</th>
                                <th>Value</th>
                                <th class="text-right w-28">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($alternativeValues as $alternativeValue)
                                <tr class="hover">
                                    {{-- Checkbox --}}
                                    <td>
                                        <input class="checkbox checkbox-sm" type="checkbox" />
                                    </td>

                                    {{-- Alternative --}}
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div>
                                                <div class="font-mono text-sm font-bold">
                                                    {{ $alternativeValue->alternative->code }}</div>
                                                <div class="font-medium">{{ $alternativeValue->alternative->name }}
                                                </div>
                                                @switch($alternativeValue->alternative->type)
                                                    @case('matic')
                                                        <x-badge color="primary" size="xs">Matic</x-badge>
                                                    @break

                                                    @case('maxi series')
                                                        <x-badge color="warning" size="xs">Maxi</x-badge>
                                                    @break

                                                    @case('classy')
                                                        <x-badge color="info" size="xs">Classy</x-badge>
                                                    @break

                                                    @case('sport')
                                                        <x-badge color="error" size="xs">Sport</x-badge>
                                                    @break

                                                    @case('offroad')
                                                        <x-badge color="success" size="xs">Offroad</x-badge>
                                                    @break

                                                    @case('moped')
                                                        <x-badge color="neutral" size="xs">Moped</x-badge>
                                                    @break

                                                    @default
                                                        <x-badge color="ghost"
                                                            size="xs">{{ ucfirst($alternativeValue->alternative->type) }}</x-badge>
                                                @endswitch
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Criteria --}}
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div>
                                                <div class="font-mono text-sm font-bold">
                                                    {{ $alternativeValue->criteria->code }}</div>
                                                <div class="font-medium">{{ $alternativeValue->criteria->name }}</div>
                                                @if ($alternativeValue->criteria->type)
                                                    <x-badge color="outline"
                                                        size="xs">{{ $alternativeValue->criteria->type }}</x-badge>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Value --}}
                                    <td>
                                        <div class="text-left">
                                            <div class="font-bold text-lg">
                                                {{ number_format($alternativeValue->value, $alternativeValue->value == floor($alternativeValue->value) ? 0 : 2) }}
                                            </div>
                                            @if ($alternativeValue->criteria->unit)
                                                <div class="text-xs text-base-content/60">
                                                    {{ $alternativeValue->criteria->unit }}</div>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Actions --}}
                                    <td class="text-center">
                                        <div class="flex justify-end gap-1">
                                            {{-- View --}}
                                            <button class="btn btn-ghost btn-xs btn-circle" title="View" disabled>
                                                <x-lucide-eye class="w-4 h-4 text-info" />
                                            </button>

                                            {{-- Edit --}}
                                            <button class="btn btn-ghost btn-xs btn-circle" title="Edit" disabled>
                                                <x-lucide-pencil class="w-4 h-4 text-warning" />
                                            </button>

                                            {{-- Delete --}}
                                            <button class="btn btn-ghost btn-xs btn-circle text-error" title="Delete"
                                                disabled>
                                                <x-lucide-trash class="w-4 h-4" />
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td class="text-center py-10" colspan="6">
                                            <div class="text-base-content/50">
                                                <x-lucide-target class="w-10 h-10 mx-auto mb-2" />
                                                <p>No alternative values found</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if ($alternativeValues->hasPages())
                        <div class="p-4 border-t border-base-200">
                            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                                <div class="text-sm text-base-content/70">
                                    Showing {{ $alternativeValues->firstItem() }} to {{ $alternativeValues->lastItem() }}
                                    of
                                    {{ $alternativeValues->total() }} results
                                </div>
                                <div class="join">
                                    {{ $alternativeValues->links() }}
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </x-app-layout>
