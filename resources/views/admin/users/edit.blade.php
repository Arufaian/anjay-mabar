<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-4">
        <!-- Header Section -->
        <x-slot name="header">
            <div class="card bg-base-100 shadow-sm mt-4">
                <div class="card-body">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="card-title text-2xl">Update User</h2>
                            <p class="text-base-content/70 mt-1">Edit user information and role settings</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-ghost btn-sm">
                                <x-lucide-arrow-left class="w-4 h-4 mr-1" />
                                Back to List
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

        <!-- Update Form -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Form -->
            <div class="lg:col-span-2">
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-lg mb-4">User Information</h3>
                        
                        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="space-y-6" x-data="{ loading: false }" @submit="loading = true">
                            @csrf
                            @method('PUT')
                            
                            <!-- Basic Information -->
                            <div class="space-y-4">
                                <h4 class="font-semibold text-base-content/80 flex items-center gap-2">
                                    <x-lucide-info class="w-4 h-4" />
                                    Basic Information
                                </h4>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <fieldset class="fieldset">
                                        <legend class="fieldset-legend">Name <span class="text-error">*</span></legend>
                                        <input 
                                            class="input w-full @error('name') input-error @enderror" 
                                            name="name" 
                                            type="text" 
                                            placeholder="Enter user name"
                                            value="{{ old('name', $user->name) }}"
                                            required 
                                        />
                                        <p class="fieldset-label">Full name of the user</p>
                                        @error('name')
                                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                    
                                    <fieldset class="fieldset">
                                        <legend class="fieldset-legend">Email <span class="text-error">*</span></legend>
                                        <input 
                                            class="input w-full @error('email') input-error @enderror" 
                                            name="email" 
                                            type="email" 
                                            placeholder="Enter email address"
                                            value="{{ old('email', $user->email) }}"
                                            required 
                                        />
                                        <p class="fieldset-label">Email address for login</p>
                                        @error('email')
                                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Role <span class="text-error">*</span></legend>
                                    <select class="select w-full @error('role') select-error @enderror" name="role" required>
                                        <option value="">Select Role</option>
                                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>
                                            User (Regular access)
                                        </option>
                                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                            Admin (Administrative access)
                                        </option>
                                        @if (!$hasOwner || $user->role === 'owner')
                                            <option value="owner" {{ old('role', $user->role) == 'owner' ? 'selected' : '' }}>
                                                Owner (Full system access)
                                            </option>
                                        @endif
                                    </select>
                                    <p class="fieldset-label">User role determines access level</p>
                                    @error('role')
                                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    @if ($hasOwner && $user->role !== 'owner')
                                        <div class="alert alert-warning">
                                            <x-lucide-alert-triangle class="w-4 h-4" />
                                            <span class="text-sm">Owner role is unavailable because an owner already exists in the system.</span>
                                        </div>
                                    @endif
                                </fieldset>
                            </div>

                            <!-- Password Settings -->
                            <div class="space-y-4 border-t pt-6">
                                <h4 class="font-semibold text-base-content/80 flex items-center gap-2">
                                    <x-lucide-lock class="w-4 h-4" />
                                    Password Settings
                                </h4>
                                
                                <div class="alert alert-info">
                                    <x-lucide-info class="w-4 h-4" />
                                    <div>
                                        <p class="text-sm">Leave password fields empty to keep the current password unchanged.</p>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <fieldset class="fieldset">
                                        <legend class="fieldset-legend">New Password</legend>
                                        <input 
                                            class="input w-full @error('password') input-error @enderror" 
                                            name="password" 
                                            type="password" 
                                            placeholder="Enter new password"
                                            value="{{ old('password') }}"
                                        />
                                        <p class="fieldset-label">Minimum 8 characters</p>
                                        @error('password')
                                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                    
                                    <fieldset class="fieldset">
                                        <legend class="fieldset-legend">Confirm Password</legend>
                                        <input 
                                            class="input w-full @error('password_confirmation') input-error @enderror" 
                                            name="password_confirmation" 
                                            type="password" 
                                            placeholder="Confirm new password"
                                            value="{{ old('password_confirmation') }}"
                                        />
                                        <p class="fieldset-label">Re-enter the new password</p>
                                        @error('password_confirmation')
                                            <p class="text-error text-xs mt-1">Password confirmation does not match.</p>
                                        @enderror
                                    </fieldset>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t">
                                <button type="submit" class="btn btn-primary w-full sm:w-auto" :disabled="loading">
                                    <x-lucide-save class="w-4 h-4 mr-2" x-show="!loading" />
                                    <span class="loading loading-spinner loading-sm" x-show="loading"></span>
                                    <span x-text="loading ? 'Updating...' : 'Update User'"></span>
                                </button>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-ghost w-full sm:w-auto">
                                    <x-lucide-x class="w-4 h-4 mr-2" />
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Current Status Card -->
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-lg mb-4">Current Status</h3>
                        
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-base-content/70">Role</span>
                                <x-badge 
                                    :color="$user->role === 'owner' ? 'warning' : ($user->role === 'admin' ? 'error' : 'success')"
                                    size="sm"
                                >
                                    {{ ucfirst($user->role) }}
                                </x-badge>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-base-content/70">Email Status</span>
                                <x-badge 
                                    :color="$user->email_verified_at ? 'primary' : 'ghost'"
                                    size="sm"
                                >
                                    {{ $user->email_verified_at ? 'Verified' : 'Unverified' }}
                                </x-badge>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-base-content/70">Member Since</span>
                                <span class="text-sm font-medium">{{ $user->created_at->format('M d, Y') }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-base-content/70">Last Updated</span>
                                <span class="text-sm font-medium">{{ $user->updated_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-lg mb-4">Quick Actions</h3>
                        
                        <div class="space-y-2">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-ghost btn-sm w-full justify-start">
                                <x-lucide-list class="w-4 h-4 mr-2" />
                                View All Users
                            </a>
                            
                            <button 
                                onclick="modal_create_user.showModal()" 
                                class="btn btn-ghost btn-sm w-full justify-start"
                            >
                                <x-lucide-plus class="w-4 h-4 mr-2" />
                                Add New User
                            </button>
                            
                            @if($user->role === 'owner')
                            <div class="alert alert-warning">
                                <x-lucide-crown class="w-4 h-4" />
                                <div>
                                    <p class="text-sm">This user has owner privileges with full system access.</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create User Modal (for quick add) -->
    <x-admin.users.create-modal />
</x-app-layout>