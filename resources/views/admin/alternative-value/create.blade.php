<x-app-layout>

    <div class="px-4 sm:px-6 lg:px-8 py-4">
        <!-- Header Section -->
        <x-slot name="header">
            <div class="card bg-base-100 shadow-sm mt-4">
                <div class="card-body">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="card-title text-2xl">Create Alternative Value</h2>
                            <p class="text-base-content/70 mt-1">Add criteria value for motorcycle alternative</p>
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

        <!-- Form Section -->
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.alternative-value.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Alternative Selection -->
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Alternative *</legend>
                        <select name="alternative_id" class="select select-bordered w-full" required>
                            <option value="">Select an alternative</option>
                            @foreach ($alternatives as $alternative)
                                <option value="{{ $alternative->id }}" {{ old('alternative_id') == $alternative->id ? 'selected' : '' }}>
                                    {{ $alternative->code }} - {{ $alternative->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('alternative_id')
                            <p class="text-error text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </fieldset>

                    <!-- Criteria Selection -->
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Criteria *</legend>
                        <select name="criteria_id" id="criteria_id" class="select select-bordered w-full" required>
                            <option value="">Select criteria</option>
                            @foreach ($criteria as $criterion)
                                <option 
                                    value="{{ $criterion->id }}" 
                                    data-unit="{{ $criterion->unit ?? '' }}"
                                    {{ old('criteria_id') == $criterion->id ? 'selected' : '' }}
                                >
                                    {{ $criterion->code }} - {{ $criterion->name }}
                                    @if($criterion->unit)
                                        ({{ $criterion->unit }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('criteria_id')
                            <p class="text-error text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </fieldset>

                    <!-- Value Input -->
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Value *</legend>
                        <div class="flex items-center gap-2">
                            <input 
                                type="number" 
                                name="value" 
                                class="input input-bordered flex-1" 
                                step="any"
                                min="0"
                                placeholder="Enter value"
                                value="{{ old('value') }}"
                                required
                            />
                            <span id="unit-display" class="text-sm text-base-content/60 text-right"></span>
                        </div>
                        @error('value')
                            <p class="text-error text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </fieldset>

                    <!-- Notes -->
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Notes</legend>
                        <textarea 
                            name="notes" 
                            class="textarea textarea-bordered w-full" 
                            rows="3"
                            placeholder="Optional notes about this value"
                        >{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="text-error text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </fieldset>

                    <!-- Form Actions -->
                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('admin.alternative-value.index') }}" class="btn btn-ghost">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <x-lucide-save class="w-4 h-4 mr-1" />
                            Create Value
                        </button>
                    </div>
                </form>
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