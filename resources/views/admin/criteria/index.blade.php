<x-app-layout>

    <div class="px-4 sm:px-6 lg:px-8 py-4">
        <!-- Header Section -->
        <x-slot name="header">
            <div class="card bg-base-100 shadow-sm mt-4">
                <div class="card-body">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="card-title text-2xl">Criteria Management</h2>
                            <p class="text-base-content/70 mt-1">Manage evaluation criteria for decision making</p>
                        </div>
                        <div class="flex gap-2">
                            <button class="btn btn-primary btn-sm" onclick="modal_create.showModal()">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Add Criteria
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </x-slot>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

            <x-admin.stats-card :title="'total criteria'" :value="$criteria->count()" color="text-primary">

                <x-slot name="icon">
                    <x-lucide-clipboard-list class="w-8 h-8" />
                </x-slot>

            </x-admin.stats-card>

            <x-admin.stats-card :title="'active criteria'" :value="$criteria->where('active', true)->count()" color="text-accent">

                <x-slot name="icon">
                    <x-lucide-monitor-check class="w-8 h-8" />
                </x-slot>

            </x-admin.stats-card>

            <x-admin.stats-card :title="'inactive criteria'" :value="$criteria->where('active', false)->count()" color="text-warning">

                <x-slot name="icon">
                    <x-lucide-monitor-off class="w-8 h-8" />
                </x-slot>

            </x-admin.stats-card>

            <x-admin.stats-card :title="'types'" :value="$criteria->pluck('type')->unique()->count()" color="text-primary">

                <x-slot name="icon">
                    <x-lucide-clipboard-type class="w-8 h-8" />
                </x-slot>

            </x-admin.stats-card>

        </div>

        <!-- Table Section -->
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body p-0">
                <!-- Search and Filter -->
                <div class="p-4 border-b border-base-200">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="form-control flex-1">
                            <input class="input input-bordered input-sm w-full" type="text"
                                placeholder="Search criteria..." />
                        </div>
                        <div class="flex gap-2">
                            <select class="select select-bordered select-sm">
                                <option value="">All Types</option>
                                <option value="cost">Cost</option>
                                <option value="benefit">Benefit</option>
                            </select>
                            <select class="select select-bordered select-sm">
                                <option value="">All Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="table table-sm">
                        <thead>
                            <tr class="bg-base-200">
                                <th class="w-12">
                                    <label>
                                        <input class="checkbox checkbox-sm" type="checkbox" />
                                    </label>
                                </th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Unit</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($criteria as $item)
                                <tr class="hover">
                                    <td>
                                        <label>
                                            <input class="checkbox checkbox-sm" type="checkbox" />
                                        </label>
                                    </td>
                                    <td>
                                        <div class="font-mono text-sm">{{ $item->code }}</div>
                                    </td>
                                    <td>
                                        <div class="font-medium">{{ $item->name }}</div>
                                        @if ($item->description)
                                            <div class="text-xs text-base-content/70">
                                                {{ Str::limit($item->description, 50) }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->type === 'benefit')
                                            <x-badge color="success" size="sm">Benefit</x-badge>
                                            
                                        @else
                                            <x-badge color="error" class="text-base-100 dark:text-black" size="sm">Cost</x-badge>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-sm">{{ $item->unit ?? '-' }}</span>
                                    </td>
                                    <td>
                                        @if ($item->active)
                                            <x-badge color="primary" size="sm">Active</x-badge>
                                        @else
                                            <x-badge color="ghost" size="sm">Inactive</x-badge>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="flex justify-end gap-1">
                                            <button class="btn btn-ghost btn-xs btn-circle" title="View">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                            <button class="btn btn-ghost btn-xs btn-circle" title="Edit">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button class="btn btn-ghost btn-xs btn-circle text-error" title="Delete">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center py-8" colspan="7">
                                        <div class="text-base-content/50">
                                            <svg class="w-12 h-12 mx-auto mb-2" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                            <p>No criteria found</p>
                                            <button class="btn btn-primary btn-sm mt-2"
                                                onclick="modal_create.showModal()">
                                                Add First Criteria
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($criteria->count() > 0)
                    <div class="p-4 border-t border-base-200">
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                            <div class="text-sm text-base-content/70">
                                Showing {{ $criteria->firstItem() }} to {{ $criteria->lastItem() }} of
                                {{ $criteria->total() }} results
                            </div>
                            <div class="join">
                                <button class="join-item btn btn-sm">«</button>
                                <button class="join-item btn btn-sm btn-active">1</button>
                                <button class="join-item btn btn-sm">2</button>
                                <button class="join-item btn btn-sm">3</button>
                                <button class="join-item btn btn-sm">»</button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <dialog class="modal" id="modal_create">
        <div class="modal-box w-11/12 max-w-2xl">
            <h3 class="font-bold text-lg mb-6">Add New Criteria</h3>
            <form method="POST" action="">
                @csrf
                <div class="grid gap-4">
                    <!-- Code Input -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Code</span>
                        </label>
                        <input class="input input-bordered input-sm w-full"  type="text" required />
                    </div>

                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Kode kriteria</legend>
                        <input class="input w-full" type="text" placeholder="masukan code untuk kriteria" name="code" required/>
                    </fieldset>

                    <!-- Name Input -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Name</span>
                        </label>
                        <input class="input input-bordered input-sm w-full" name="name" type="text" required />
                    </div>

                    <!-- Type Select -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Type</span>
                        </label>
                        <select class="select select-bordered select-sm w-full" name="type" required>
                            <option value="">Select Type</option>
                            <option value="benefit">Benefit</option>
                            <option value="cost">Cost</option>
                        </select>
                    </div>

                    <!-- Unit Input -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Unit</span>
                        </label>
                        <input class="input input-bordered input-sm w-full" name="unit" type="text" />
                    </div>

                    <!-- Description Textarea -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Description</span>
                        </label>
                        <textarea class="textarea textarea-bordered textarea-sm w-full" name="description" rows="3"></textarea>
                    </div>

                    <!-- Active Checkbox -->
                    <div class="form-control mt-2">
                        <label class="label cursor-pointer justify-start gap-3">
                            <input class="checkbox checkbox-sm" name="active" type="checkbox" checked />
                            <span class="label-text font-medium">Active</span>
                        </label>
                    </div>
                </div>

                <!-- Modal Actions -->
                <div class="modal-action mt-6">
                    <button class="btn btn-outline btn-sm" type="button"
                        onclick="modal_create.close()">Cancel</button>
                    <button class="btn btn-primary btn-sm" type="submit">Save</button>
                </div>
            </form>
        </div>

        <!-- Modal Backdrop -->
        <form class="modal-backdrop" method="dialog">
            <button>close</button>
        </form>
    </dialog>

</x-app-layout>
