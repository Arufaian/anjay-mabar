<x-app-layout>

    @php
        $criteriaCount = App\Models\Criteria::count();
    @endphp

    <div class="px-4 sm:px-6 lg:px-8 py-4">
        <!-- Header Section -->
        <x-slot name="header">
            <div class="card bg-base-100 shadow-sm mt-4">
                <div class="card-body">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="card-title text-2xl">Alternative Management</h2>
                            <p class="text-base-content/70 mt-1">Manage motorcycle alternatives for decision analysis</p>
                        </div>

                        <div class="flex gap-2">
                            <button class="btn btn-primary btn-sm" onclick="modal_create_alternative.showModal()">
                                <x-lucide-plus class="w-4 h-4 mr-1" />
                                Add Alternative
                            </button>
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

        <!-- create alternative modal -->
        <x-admin.alternative.create-modal />

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

            <x-admin.stats-card :title="'total alternatives'" :value="$alternatives->total()" color="text-primary">

                <x-slot name="icon">
                    <x-lucide-motorbike class="w-8 h-8" />
                </x-slot>

            </x-admin.stats-card>

            <x-admin.stats-card :title="'matic types'" :value="$alternatives->where('type', 'matic')->count()" color="text-accent">

                <x-slot name="icon">
                    <x-lucide-zap class="w-8 h-8" />
                </x-slot>

            </x-admin.stats-card>

            <x-admin.stats-card :title="'maxi series'" :value="$alternatives->where('type', 'maxi series')->count()" color="text-warning">

                <x-slot name="icon">
                    <x-lucide-crown class="w-8 h-8" />
                </x-slot>

            </x-admin.stats-card>

            <x-admin.stats-card :title="'unique years'" :value="$alternatives->pluck('year')->unique()->count()" color="text-info">

                <x-slot name="icon">
                    <x-lucide-calendar class="w-8 h-8" />
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
                                placeholder="Search alternatives by name, code, or model..." />
                        </div>

                        <div class="flex gap-2">
                            <select class="select select-bordered select-sm" name="type">
                                <option value="">All Types</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type }}" @selected(request('type') === $type)>
                                        {{ ucfirst($type) }}</option>
                                @endforeach
                            </select>

                            <select class="select select-bordered select-sm" name="year">
                                <option value="">All Years</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" @selected(request('year') == $year)">
                                        {{ $year }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-primary btn-sm" type="submit">Filter</button>
                    </form>
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="table table-sm">
                        <thead>
                            <tr class="bg-base-200">
                                <th class="w-12">
                                    <input class="checkbox checkbox-sm" type="checkbox" />
                                </th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Model</th>
                                <th>Type</th>
                                <th>Year</th>
                                <th>Criteria Values</th>
                                <th class="text-right w-28">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($alternatives as $alternative)
                                <tr class="hover">
                                    {{-- Checkbox --}}
                                    <td>
                                        <input class="checkbox checkbox-sm" type="checkbox" />
                                    </td>

                                    {{-- Code --}}
                                    <td>
                                        <div class="font-mono text-sm font-bold">{{ $alternative->code }}</div>
                                    </td>

                                    {{-- Name --}}
                                    <td>
                                        <div class="font-medium">{{ $alternative->name }}</div>
                                        @if ($alternative->description)
                                            <div class="text-xs text-base-content/50 mt-1 truncate">
                                                {{ Str::limit($alternative->description, 50) }}</div>
                                        @endif
                                    </td>

                                    {{-- Model --}}
                                    <td>
                                        <div class="text-sm">{{ $alternative->model ?? '-' }}</div>
                                    </td>

                                    {{-- Type --}}
                                    <td>
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
                                                <x-badge color="ghost"
                                                    size="sm">{{ ucfirst($alternative->type) }}</x-badge>
                                        @endswitch
                                    </td>

                                    {{-- Year --}}
                                    <td>
                                        <span class="text-sm">{{ $alternative->year ?? '-' }}</span>
                                    </td>

                                    {{-- Criteria Values Count --}}
                                    <td>

                                        @if ($alternative->alternativeValues->count() < $criteriaCount)
                                            <x-badge color="warning"
                                                size="sm">{{ $alternative->alternativeValues->count() }}
                                                / {{ $criteriaCount }} values</x-badge>
                                        @else
                                            <div class="flex items-center gap-2">
                                                <x-badge color="accent"
                                                    size="sm">{{ $alternative->alternativeValues->count() }}
                                                    values</x-badge>
                                            </div>
                                        @endif

                                    </td>

                                    {{-- Actions --}}
                                    <td class="text-center">
                                        <div class="flex justify-end gap-1">
                                            {{-- View --}}
                                            <a class="btn btn-ghost btn-xs btn-circle"
                                                href="{{ route('admin.alternative.show', $alternative->id) }}"
                                                title="View">
                                                <x-lucide-eye class="w-4 h-4 text-info" />
                                            </a>

                                            {{-- Edit --}}
                                            <a class="btn btn-ghost btn-xs btn-circle"
                                                href="{{ route('admin.alternative.edit', $alternative->id) }}"
                                                title="Edit">
                                                <x-lucide-pencil class="w-4 h-4 text-warning" />
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('admin.alternative.destroy', $alternative->id) }}"
                                                method="POST" onsubmit="return confirm('Delete this alternative?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-ghost btn-xs btn-circle text-error"
                                                    type="submit" title="Delete">
                                                    <x-lucide-trash class="w-4 h-4" />
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td class="text-center py-10" colspan="8">
                                            <div class="text-base-content/50">
                                                <x-lucide-motorbike class="w-10 h-10 mx-auto mb-2" />
                                                <p>No alternatives found</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if ($alternatives->hasPages())
                        <div class="p-4 border-t border-base-200">
                            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                                <div class="text-sm text-base-content/70">
                                    Showing {{ $alternatives->firstItem() }} to {{ $alternatives->lastItem() }} of
                                    {{ $alternatives->total() }} results
                                </div>
                                <div class="join">
                                    {{ $alternatives->links() }}
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </div>

    </x-app-layout>
