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
                                <x-lucide-plus class="w-4 h-4 mr-1" />
                                Add Criteria
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
        <x-admin.criteria.table :criteria="$criteria" />
    </div>

    <!-- Create Modal -->
    <x-admin.criteria.create-modal />

</x-app-layout>
