<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-4">
        <!-- Header Section -->
        <x-slot name="header">
            <div class="card bg-base-100 shadow-sm mt-4">
                <div class="card-body">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="card-title text-2xl">Update Alternative</h2>
                            <p class="text-base-content/70 mt-1">Edit motorcycle alternative information</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.alternative.index') }}" class="btn btn-ghost btn-sm">
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
                        <h3 class="card-title text-lg mb-4">Alternative Information</h3>
                        
                        <form method="POST" action="{{ route('admin.alternative.update', $alternative->id) }}" class="space-y-6" x-data="{ loading: false }" @submit="loading = true">
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
                                            placeholder="Enter alternative name"
                                            value="{{ old('name', $alternative->name) }}"
                                            required 
                                            maxlength="150"
                                        />
                                        <p class="fieldset-label">Name of the motorcycle alternative</p>
                                        @error('name')
                                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                    
                                    <fieldset class="fieldset">
                                        <legend class="fieldset-legend">Type <span class="text-error">*</span></legend>
                                        <select class="select w-full @error('type') select-error @enderror" name="type" required>
                                            <option value="">Select Type</option>
                                            <option value="matic" {{ old('type', $alternative->type) === 'matic' ? 'selected' : '' }}>
                                                Matic
                                            </option>
                                            <option value="maxi series" {{ old('type', $alternative->type) === 'maxi series' ? 'selected' : '' }}>
                                                Maxi Series
                                            </option>
                                            <option value="classy" {{ old('type', $alternative->type) === 'classy' ? 'selected' : '' }}>
                                                Classy
                                            </option>
                                            <option value="sport" {{ old('type', $alternative->type) === 'sport' ? 'selected' : '' }}>
                                                Sport
                                            </option>
                                            <option value="offroad" {{ old('type', $alternative->type) === 'offroad' ? 'selected' : '' }}>
                                                Offroad
                                            </option>
                                            <option value="moped" {{ old('type', $alternative->type) === 'moped' ? 'selected' : '' }}>
                                                Moped
                                            </option>
                                        </select>
                                        <p class="fieldset-label">Motorcycle type category</p>
                                        @error('type')
                                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <fieldset class="fieldset">
                                        <legend class="fieldset-legend">Model</legend>
                                        <input 
                                            class="input w-full @error('model') input-error @enderror" 
                                            name="model" 
                                            type="text" 
                                            placeholder="Enter model name"
                                            value="{{ old('model', $alternative->model) }}"
                                            maxlength="255"
                                        />
                                        <p class="fieldset-label">Specific model name or variant</p>
                                        @error('model')
                                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                    
                                    <fieldset class="fieldset">
                                        <legend class="fieldset-legend">Year</legend>
                                        <input 
                                            class="input w-full @error('year') input-error @enderror" 
                                            name="year" 
                                            type="number" 
                                            placeholder="Enter year"
                                            value="{{ old('year', $alternative->year) }}"
                                            min="1900"
                                            max="{{ date('Y') + 1 }}"
                                            maxlength="4"
                                        />
                                        <p class="fieldset-label">Production year (4 digits)</p>
                                        @error('year')
                                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                </div>

                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Description</legend>
                                    <textarea 
                                        class="textarea w-full @error('description') textarea-error @enderror" 
                                        name="description" 
                                        placeholder="Enter description"
                                        rows="4"
                                    >{{ old('description', $alternative->description) }}</textarea>
                                    <p class="fieldset-label">Additional information about the alternative</p>
                                    @error('description')
                                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </fieldset>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-3 pt-6">
                                <button type="submit" class="btn btn-primary w-full sm:w-auto" :disabled="loading">
                                    <x-lucide-save class="w-4 h-4 mr-2" x-show="!loading" />
                                    <span class="loading loading-spinner loading-sm" x-show="loading"></span>
                                    <span x-text="loading ? 'Updating...' : 'Update Alternative'"></span>
                                </button>
                                <a href="{{ route('admin.alternative.index') }}" class="btn btn-ghost w-full sm:w-auto">
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
                                <span class="text-sm text-base-content/70">Code</span>
                                <x-badge color="secondary" size="sm">{{ $alternative->code }}</x-badge>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-base-content/70">Type</span>
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
                                        <x-badge color="ghost" size="sm">{{ ucfirst($alternative->type) }}</x-badge>
                                @endswitch
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-base-content/70">Model</span>
                                <span class="text-sm font-medium">{{ $alternative->model ?? '-' }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-base-content/70">Year</span>
                                <span class="text-sm font-medium">{{ $alternative->year ?? '-' }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-base-content/70">Created</span>
                                <span class="text-sm font-medium">{{ $alternative->created_at->format('M d, Y') }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-base-content/70">Last Updated</span>
                                <span class="text-sm font-medium">{{ $alternative->updated_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-lg mb-4">Quick Actions</h3>
                        
                        <div class="space-y-2">
                            <a href="{{ route('admin.alternative.index') }}" class="btn btn-ghost btn-sm w-full justify-start">
                                <x-lucide-list class="w-4 h-4 mr-2" />
                                View All Alternatives
                            </a>
                            
                            <a href="{{ route('admin.alternative.show', $alternative->id) }}" class="btn btn-ghost btn-sm w-full justify-start">
                                <x-lucide-eye class="w-4 h-4 mr-2" />
                                View Details
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Criteria Values Status -->
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-lg mb-4">Criteria Values</h3>
                        
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-base-content/70">Total Values</span>
                                <span class="text-sm font-medium">{{ $alternative->alternativeValues->count() }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-base-content/70">Status</span>
                                @php
                                    $criteriaCount = \App\Models\Criteria::count();
                                    $hasAllValues = $alternative->alternativeValues->count() >= $criteriaCount;
                                @endphp
                                @if($hasAllValues)
                                    <x-badge color="success" size="sm">Complete</x-badge>
                                @else
                                    <x-badge color="warning" size="sm">Incomplete</x-badge>
                                @endif
                            </div>
                            
                            <a href="{{ route('admin.alternative.show', $alternative->id) }}#criteria-values" class="btn btn-primary btn-sm w-full">
                                <x-lucide-target class="w-4 h-4 mr-2" />
                                Manage Values
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>