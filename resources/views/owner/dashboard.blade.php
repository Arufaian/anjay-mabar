<x-app-layout>
    <x-slot name="header">
        <div class="card bg-base-100 shadow-sm mt-4">
            <div class="card-body">
                <h2 class="card-title text-2xl">Owner Dashboard</h2>
                <p class="text-base-content/70">System overview and user management</p>
            </div>
        </div>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Quick Stats -->
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">Quick Stats</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-primary">{{ App\Models\User::count() }}</div>
                            <div class="text-sm opacity-70">Total Users</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-accent">{{ App\Models\User::where('role', 'admin')->count() }}</div>
                            <div class="text-sm opacity-70">Admins</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">Quick Actions</h3>
                    <div class="space-y-2">
                        <a href="{{ route('owner.users.index') }}" class="btn btn-outline btn-block">
                            <x-lucide-users class="w-4 h-4 mr-2" />
                            View All Users
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">Recent Users</h3>
                    <div class="space-y-2">
                        @php
                        $recentUsers = App\Models\User::latest()->take(3)->get();
                        @endphp
                        @foreach($recentUsers as $user)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="avatar avatar-placeholder">
                                    <div class="bg-neutral text-neutral-content w-8 rounded-full">
                                        <span class="text-xs">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-sm font-medium">{{ $user->name }}</div>
                                    <div class="text-xs opacity-70">{{ $user->role }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
