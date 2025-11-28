@props(['criteria', 'search' => request('search'), 'type' => request('type'), 'status' => request('status')])

<div class="card bg-base-100 shadow-sm">
    <div class="card-body p-0">

        {{-- Search & Filters --}}
        <div class="p-4 border-b border-base-200">
            <form class="flex flex-col sm:flex-row gap-4" method="GET">

                <div class="form-control flex-1">
                    <input class="input input-bordered input-sm w-full" name="search" type="text"
                        value="{{ $search }}" placeholder="Search criteria..." />
                </div>

                <div class="flex gap-2">
                    <select class="select select-bordered select-sm" name="type">
                        <option value="">All Types</option>
                        <option value="benefit" @selected($type === 'benefit')>Benefit</option>
                        <option value="cost" @selected($type === 'cost')>Cost</option>
                    </select>

                    <select class="select select-bordered select-sm" name="status">
                        <option value="">All Status</option>
                        <option value="1" @selected($status === '1')>Active</option>
                        <option value="0" @selected($status === '0')>Inactive</option>
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
                        <th>Type</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th class="text-right w-28">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($criteria as $item)
                        <x-admin.criteria.row :item="$item" />
                    @empty
                        <tr>
                            <td class="text-center py-10" colspan="7">
                                <div class="text-base-content/50">
                                    <x-lucide-file-text class="w-10 h-10 mx-auto mb-2" />
                                    <p>No criteria found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($criteria->hasPages())
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
