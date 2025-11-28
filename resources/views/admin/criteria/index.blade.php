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
            <div class="stat bg-base-100 shadow-sm rounded-lg">
                <div class="stat-figure text-primary">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div class="stat-title">Total Criteria</div>
                <div class="stat-value text-primary">{{ $criteria->count() }}</div>
            </div>

            <div class="stat bg-base-100 shadow-sm rounded-lg">
                <div class="stat-figure text-success">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="stat-title">Active</div>
                <div class="stat-value text-success">{{ $criteria->where('active', true)->count() }}</div>
            </div>

            <div class="stat bg-base-100 shadow-sm rounded-lg">
                <div class="stat-figure text-warning">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="stat-title">Inactive</div>
                <div class="stat-value text-warning">{{ $criteria->where('active', false)->count() }}</div>
            </div>

            <div class="stat bg-base-100 shadow-sm rounded-lg">
                <div class="stat-figure text-info">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div class="stat-title">Types</div>
                <div class="stat-value text-info">{{ $criteria->pluck('type')->unique()->count() }}</div>
            </div>
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
                                            <span class="badge badge-success badge-sm">Benefit</span>
                                        @else
                                            <span class="badge badge-error badge-sm">Cost</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-sm">{{ $item->unit ?? '-' }}</span>
                                    </td>
                                    <td>
                                        @if ($item->active)
                                            <span class="badge badge-primary badge-sm">Active</span>
                                        @else
                                            <span class="badge badge-ghost badge-sm">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="flex justify-end gap-1">
                                            <button class="btn btn-ghost btn-xs btn-circle" title="View">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                            <button class="btn btn-ghost btn-xs btn-circle" title="Edit">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button class="btn btn-ghost btn-xs btn-circle text-error" title="Delete">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                                Showing {{ $criteria->firstItem() }} to {{ $criteria->lastItem() }} of {{ $criteria->total() }} results
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
        <div class="modal-box">
            <h3 class="font-bold text-lg mb-4">Add New Criteria</h3>
            <form method="POST" action="">
                @csrf
                <div class="grid gap-4">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Code</span>
                        </label>
                        <input class="input input-bordered" name="code" type="text" required />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Name</span>
                        </label>
                        <input class="input input-bordered" name="name" type="text" required />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Type</span>
                        </label>
                        <select class="select select-bordered" name="type" required>
                            <option value="">Select Type</option>
                            <option value="benefit">Benefit</option>
                            <option value="cost">Cost</option>
                        </select>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Unit</span>
                        </label>
                        <input class="input input-bordered" name="unit" type="text" />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Description</span>
                        </label>
                        <textarea class="textarea textarea-bordered" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-control">
                        <label class="label cursor-pointer">
                            <span class="label-text">Active</span>
                            <input class="checkbox" name="active" type="checkbox" checked />
                        </label>
                    </div>
                </div>
                <div class="modal-action">
                    <button class="btn" type="button" onclick="modal_create.close()">Cancel</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
        <form class="modal-backdrop" method="dialog">
            <button>close</button>
        </form>
    </dialog>

</x-app-layout>
