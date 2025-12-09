<x-app-layout>

    <x-slot name="header">
        <div class="card bg-base-100 shadow-sm mt-4 mb-4">
            <div class="card-body">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="card-title text-2xl">Dashboard</h2>
                        <p class="text-base-content/70 mt-1">Selamat datang admin</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
            {{-- Total Users Card --}}
            <x-stats-card value="{{ App\Models\User::count() }}" title="Total Users" subtitle="Registered users"
                :icon="'users'" color="primary" route="users" />

            <x-stats-card value="{{ App\Models\Criteria::count() }}" title="Total Criteria"
                subtitle="Registered criteria" :icon="'check-square'" color="accent" route="criteria" />

            <x-stats-card title="Bobot kriteria"
                subtitle="Ubah bobot kriteria" :icon="'scale'" color="warning" route="weights" />

        </div>
    </div>
</x-app-layout>
