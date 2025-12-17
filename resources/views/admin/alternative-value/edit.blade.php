<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-4">
        <!-- Header Section -->
        <x-slot name="header">
            <div class="card bg-base-100 shadow-sm mt-4">
                <div class="card-body">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="card-title text-2xl">Update Alternative Value</h2>
                            <p class="text-base-content/70 mt-1">Edit criteria value for motorcycle alternative</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.alternative-value.index') }}" class="btn btn-ghost btn-sm">
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
                        <h3 class="card-title text-lg mb-4">Edit Alternative Value</h3>
                        
                        <form method="POST" action="{{ route('admin.alternative-value.update', $alternativeValue->id) }}" class="space-y-6" x-data="{ loading: false }" @submit="loading = true">
                            @csrf
                            @method('PUT')
                            
                            <!-- Alternative Selection -->
                            <div class="space-y-4">
                                <h4 class="font-semibold text-base-content/80 flex items-center gap-2">
                                    <x-lucide-motorbike class="w-4 h-4" />
                                    Alternative Information
                                </h4>
                                
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Alternative <span class="text-error">*</span></legend>
                                    <select name="alternative_id" class="select select-bordered w-full @error('alternative_id') select-error @enderror" required>
                                        <option value="">Select an alternative</option>
                                        @foreach ($alternatives as $alternative)
                                            <option value="{{ $alternative->id }}" {{ old('alternative_id', $alternativeValue->alternative_id) == $alternative->id ? 'selected' : '' }}>
                                                {{ $alternative->code }} - {{ $alternative->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="fieldset-label">Motorcycle alternative to evaluate</p>
                                    @error('alternative_id')
                                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </fieldset>

                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Criteria <span class="text-error">*</span></legend>
                                    <select name="criteria_id" id="criteria_id" class="select select-bordered w-full @error('criteria_id') select-error @enderror" required>
                                        <option value="">Select criteria</option>
                                        @foreach ($criteria as $criterion)
                                            <option 
                                                value="{{ $criterion->id }}" 
                                                data-unit="{{ $criterion->unit ?? '' }}"
                                                {{ old('criteria_id', $alternativeValue->criteria_id) == $criterion->id ? 'selected' : '' }}
                                            >
                                                {{ $criterion->code }} - {{ $criterion->name }}
                                                @if($criterion->unit)
                                                    ({{ $criterion->unit }})
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="fieldset-label">Evaluation criteria for the alternative</p>
                                    @error('criteria_id')
                                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </fieldset>
                            </div>

                            <!-- Value Settings -->
                            <div class="space-y-4 border-t border-base-content/50 pt-6">
                                <h4 class="font-semibold text-base-content/80 flex items-center gap-2">
                                    <x-lucide-target class="w-4 h-4" />
                                    Value Settings
                                </h4>
                                
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Value <span class="text-error">*</span></legend>
                                    <div class="flex items-center gap-2">
                                        <input 
                                            type="number" 
                                            name="value" 
                                            class="input input-bordered flex-1 @error('value') input-error @enderror" 
                                            step="any"
                                            min="0"
                                            placeholder="Enter value"
                                            value="{{ old('value', $alternativeValue->value) }}"
                                            required
                                        />
                                        <span id="unit-display" class="text-sm text-base-content/60 text-right">{{ $alternativeValue->criteria->unit ?? '' }}</span>
                                    </div>
                                    <p class="fieldset-label">Numerical value for the criteria evaluation</p>
                                    @error('value')
                                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </fieldset>
                                
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Notes</legend>
                                    <textarea 
                                        name="notes" 
                                        class="textarea textarea-bordered w-full @error('notes') textarea-error @enderror" 
                                        rows="3"
                                        placeholder="Optional notes about this value"
                                    >{{ old('notes', $alternativeValue->notes) }}</textarea>
                                    <p class="fieldset-label">Additional information or comments</p>
                                    @error('notes')
                                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </fieldset>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-base-content/50">
                                <button type="submit" class="btn btn-primary w-full sm:w-auto" :disabled="loading">
                                    <x-lucide-save class="w-4 h-4 mr-2" x-show="!loading" />
                                    <span class="loading loading-spinner loading-sm" x-show="loading"></span>
                                    <span x-text="loading ? 'Updating...' : 'Update Value'"></span>
                                </button>
                                <a href="{{ route('admin.alternative-value.index') }}" class="btn btn-ghost w-full sm:w-auto">
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
                                <span class="text-sm text-base-content/70">Alternative</span>
                                <div class="text-right">
                                    <div class="font-mono text-sm font-bold">{{ $alternativeValue->alternative->code }}</div>
                                    <div class="text-xs">{{ $alternativeValue->alternative->name }}</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-base-content/70">Criteria</span>
                                <div class="text-right">
                                    <div class="font-mono text-sm font-bold">{{ $alternativeValue->criteria->code }}</div>
                                    <div class="text-xs">{{ $alternativeValue->criteria->name }}</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-base-content/70">Current Value</span>
                                <span class="font-bold text-lg">
                                    {{ number_format($alternativeValue->value, $alternativeValue->value == floor($alternativeValue->value) ? 0 : 2) }}
                                    @if ($alternativeValue->criteria->unit)
                                        <span class="text-xs text-base-content/60">{{ $alternativeValue->criteria->unit }}</span>
                                    @endif
                                </span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-base-content/70">Last Updated</span>
                                <span class="text-sm font-medium">{{ $alternativeValue->updated_at->format('M d, Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-lg mb-4">Quick Actions</h3>
                        
                        <div class="space-y-2">
                            <a href="{{ route('admin.alternative-value.index') }}" class="btn btn-ghost btn-sm w-full justify-start">
                                <x-lucide-list class="w-4 h-4 mr-2" />
                                View All Values
                            </a>
                            
                            <a href="{{ route('admin.alternative-value.create') }}" class="btn btn-ghost btn-sm w-full justify-start">
                                <x-lucide-plus class="w-4 h-4 mr-2" />
                                Add New Value
                            </a>
                            
                            <a href="{{ route('admin.alternative.show', $alternativeValue->alternative_id) }}" class="btn btn-ghost btn-sm w-full justify-start">
                                <x-lucide-motorbike class="w-4 h-4 mr-2" />
                                View Alternative
                            </a>
                            
                            <a href="{{ route('admin.criteria.index') }}" class="btn btn-ghost btn-sm w-full justify-start">
                                <x-lucide-list-checks class="w-4 h-4 mr-2" />
                                Manage Criteria
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for unit display -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const criteriaSelect = document.getElementById('criteria_id');
            const unitDisplay = document.getElementById('unit-display');
            
            function updateUnitDisplay() {
                const selectedOption = criteriaSelect.options[criteriaSelect.selectedIndex];
                const unit = selectedOption.getAttribute('data-unit') || '';
                unitDisplay.textContent = unit;
            }
            
            // Initial display
            updateUnitDisplay();
            
            // Update on change
            criteriaSelect.addEventListener('change', updateUnitDisplay);
        });
    </script>
</x-app-layout>