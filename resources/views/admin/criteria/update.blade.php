<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-4">
        <!-- Header Section -->
        <x-slot name="header">
            <div class="card bg-base-100 shadow-sm mt-4">
                <div class="card-body">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="card-title text-2xl">Update Criteria</h2>
                            <p class="text-base-content/70 mt-1">Edit criteria information and settings</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.criteria.index') }}" class="btn btn-ghost btn-sm">
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
                        <h3 class="card-title text-lg mb-4">Criteria Information</h3>
                        
                        <form method="POST" action="{{ route('admin.criteria.update', $criteria->id) }}" class="space-y-6" x-data="{ loading: false }" @submit="loading = true">
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
                                        <legend class="fieldset-legend">Code <span class="text-error">*</span></legend>
                                        <input 
                                            class="input w-full @error('code') input-error @enderror" 
                                            name="code" 
                                            type="text" 
                                            placeholder="Enter criteria code"
                                            value="{{ old('code', $criteria->code) }}"
                                            required 
                                        />
                                        <p class="fieldset-label">Unique identifier for this criteria</p>
                                        @error('code')
                                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                    
                                    <fieldset class="fieldset">
                                        <legend class="fieldset-legend">Name <span class="text-error">*</span></legend>
                                        <input 
                                            class="input w-full @error('name') input-error @enderror" 
                                            name="name" 
                                            type="text" 
                                            placeholder="Enter criteria name"
                                            value="{{ old('name', $criteria->name) }}"
                                            required 
                                        />
                                        <p class="fieldset-label">Display name for this criteria</p>
                                        @error('name')
                                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <fieldset class="fieldset">
                                        <legend class="fieldset-legend">Type <span class="text-error">*</span></legend>
                                        <select class="select w-full @error('type') select-error @enderror" name="type" required>
                                            <option value="">Select Type</option>
                                            <option value="benefit" {{ old('type', $criteria->type) == 'benefit' ? 'selected' : '' }}>
                                                Benefit (Higher is better)
                                            </option>
                                            <option value="cost" {{ old('type', $criteria->type) == 'cost' ? 'selected' : '' }}>
                                                Cost (Lower is better)
                                            </option>
                                        </select>
                                        <p class="fieldset-label">How this criteria affects the decision</p>
                                        @error('type')
                                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                    
                                    <fieldset class="fieldset">
                                        <legend class="fieldset-legend">Unit</legend>
                                        <input 
                                            class="input w-full" 
                                            name="unit" 
                                            type="text" 
                                            placeholder="e.g., kg, $, %"
                                            value="{{ old('unit', $criteria->unit) }}"
                                        />
                                        <p class="fieldset-label">Measurement unit (optional)</p>
                                    </fieldset>
                                </div>

                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Description</legend>
                                    <textarea 
                                        class="textarea w-full" 
                                        name="description" 
                                        rows="4" 
                                        placeholder="Enter criteria description"
                                    >{{ old('description', $criteria->description) }}</textarea>
                                    <p class="fieldset-label">Detailed explanation of this criteria</p>
                                </fieldset>
                            </div>

                            <!-- Status Settings -->
                            <div class="space-y-4 border-t pt-6">
                                <h4 class="font-semibold text-base-content/80 flex items-center gap-2">
                                    <x-lucide-settings class="w-4 h-4" />
                                    Status Settings
                                </h4>
                                
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Active Status</legend>
                                    <label class="label cursor-pointer justify-start gap-3">
                                        <input 
                                            name="active" 
                                            type="hidden" 
                                            value="0"
                                        />
                                        <input 
                                            class="checkbox checkbox-primary" 
                                            name="active" 
                                            type="checkbox" 
                                            value="1" 
                                            {{ old('active', $criteria->active) ? 'checked' : '' }}
                                        />
                                        <span class="label-text">Enable this criteria for evaluation</span>
                                    </label>
                                    <p class="fieldset-label">Inactive criteria won't appear in evaluation forms</p>
                                </fieldset>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t">
                                <button type="submit" class="btn btn-primary w-full sm:w-auto" :disabled="loading">
                                    <x-lucide-save class="w-4 h-4 mr-2" x-show="!loading" />
                                    <span class="loading loading-spinner loading-sm" x-show="loading"></span>
                                    <span x-text="loading ? 'Updating...' : 'Update Criteria'"></span>
                                </button>
                                <a href="{{ route('admin.criteria.index') }}" class="btn btn-ghost w-full sm:w-auto">
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
                                <span class="text-sm text-base-content/70">Status</span>
                                <x-badge 
                                    :color="$criteria->active ? 'success' : 'warning'"
                                    size="sm"
                                >
                                    {{ $criteria->active ? 'Active' : 'Inactive' }}
                                </x-badge>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-base-content/70">Type</span>
                                <x-badge 
                                    :color="$criteria->type === 'benefit' ? 'success' : 'info'"
                                    size="sm"
                                >
                                    {{ ucfirst($criteria->type) }}
                                </x-badge>
                            </div>
                            
                            @if($criteria->unit)
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-base-content/70">Unit</span>
                                <span class="text-sm font-medium">{{ $criteria->unit }}</span>
                            </div>
                            @endif
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-base-content/70">Created</span>
                                <span class="text-sm font-medium">{{ $criteria->created_at->format('M d, Y') }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-base-content/70">Last Updated</span>
                                <span class="text-sm font-medium">{{ $criteria->updated_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-lg mb-4">Quick Actions</h3>
                        
                        <div class="space-y-2">
                            <a href="{{ route('admin.criteria.index') }}" class="btn btn-ghost btn-sm w-full justify-start">
                                <x-lucide-list class="w-4 h-4 mr-2" />
                                View All Criteria
                            </a>
                            
                            <button 
                                onclick="modal_create.showModal()" 
                                class="btn btn-ghost btn-sm w-full justify-start"
                            >
                                <x-lucide-plus class="w-4 h-4 mr-2" />
                                Add New Criteria
                            </button>
                            
                            @if($criteria->alternatives()->count() > 0)
                            <div class="alert alert-info">
                                <x-lucide-info class="w-4 h-4" />
                                <div>
                                    <p class="text-sm">This criteria is used by {{ $criteria->alternatives()->count() }} alternatives</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal (for quick add) -->
    <x-admin.criteria.create-modal />
</x-app-layout>
