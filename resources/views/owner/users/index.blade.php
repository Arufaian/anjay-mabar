<x-app-layout>

    <div class="px-4 sm:px-6 lg:px-8 py-4">
        <!-- Header Section -->
        <x-slot name="header">
            <div class="card bg-base-100 shadow-sm mt-4">
                <div class="card-body">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="card-title text-2xl">User Overview</h2>
                            <p class="text-base-content/70 mt-1">View all system users and their roles</p>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>

        {{-- stat card --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

            <x-admin.stats-card :title="'total users'" :value="$users->total()" color="text-primary">

                <x-slot name="icon">
                    <x-lucide-users class="w-8 h-8" />
                </x-slot>

            </x-admin.stats-card>

            <x-admin.stats-card :title="'admin users'" :value="$users->where('role', 'admin')->count()" color="text-accent">

                <x-slot name="icon">
                    <x-lucide-shield class="w-8 h-8" />
                </x-slot>

            </x-admin.stats-card>

            <x-admin.stats-card :title="'regular users'" :value="$users->where('role', 'user')->count()" color="text-warning">

                <x-slot name="icon">
                    <x-lucide-user class="w-8 h-8" />
                </x-slot>

            </x-admin.stats-card>

            <x-admin.stats-card :title="'owner users'" :value="$users->where('role', 'owner')->count()" color="text-info">

                <x-slot name="icon">
                    <x-lucide-crown class="w-8 h-8" />
                </x-slot>

            </x-admin.stats-card>

        </div>

        <div class="bg-base-100 mb-6">
            <div class="card-body p-0">
                {{-- Search & Filters --}}
                <div class="p-4 border-b border-base-200">
                    <form class="flex flex-col sm:flex-row gap-4" method="GET">

                        <div class="form-control flex-1">
                            <input class="input input-bordered input-sm w-full" name="search" type="text"
                                value="{{ request('search') }}" placeholder="Search users by name or email..." />
                        </div>

                        <div class="flex gap-2">
                            <select class="select select-bordered select-sm" name="role">
                                <option value="">All Roles</option>
                                <option value="admin" @selected(request('role') === 'admin')">Admin</option>
                                <option value="user" @selected(request('role') === 'user')">User</option>
                                <option value="owner" @selected(request('role') === 'owner')">Owner</option>
                            </select>

                            <select class="select select-bordered select-sm" name="verified">
                                <option value="">All Status</option>
                                <option value="1" @selected(request('verified') === '1')">Verified</option>
                                <option value="0" @selected(request('verified') === '0')">Unverified</option>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Joined</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($users as $user)
                                <tr class="hover">
                                    {{-- Checkbox --}}
                                    <td>
                                        <input class="checkbox checkbox-sm" type="checkbox" />
                                    </td>

                                    {{-- Name + Avatar --}}
                                    <td class="text-sm">
                                        {{ $user->name }}
                                    </td>

                                    {{-- Email --}}
                                    <td>
                                        <div class="text-sm">{{ $user->email }}</div>
                                    </td>

                                    {{-- Role --}}
                                    <td>
                                        @switch($user->role)
                                            @case('admin')
                                                <x-badge color="error" size="sm">Admin</x-badge>
                                            @break

                                            @case('owner')
                                                <x-badge color="warning" size="sm">Owner</x-badge>
                                            @break

                                            @default
                                                <x-badge color="success" size="sm">User</x-badge>
                                        @endswitch
                                    </td>

                                    {{-- Email Verification Status --}}
                                    <td>
                                        @if ($user->email_verified_at)
                                            <x-badge color="primary" size="sm">Verified</x-badge>
                                        @else
                                            <x-badge color="ghost" size="sm">Unverified</x-badge>
                                        @endif
                                    </td>

                                    {{-- Joined Date --}}
                                    <td>
                                        <span class="text-sm">{{ $user->created_at->format('M d, Y') }}</span>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td class="text-center py-10" colspan="7">
                                            <div class="text-base-content/50">
                                                <x-lucide-users class="w-10 h-10 mx-auto mb-2" />
                                                <p>No users found</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if ($users->hasPages())
                        <div class="p-4 border-t border-base-200">
                            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                                <div class="text-sm text-base-content/70">
                                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of
                                    {{ $users->total() }} results
                                </div>
                                <div class="join">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </x-app-layout>
