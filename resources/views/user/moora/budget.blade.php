<x-app-layout>
    <x-slot name="header">
        <div class="card bg-base-100 shadow-sm mt-4">
            <div class="card-body">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="card-title text-2xl">Motorcycle Analysis</h2>
                        <p class="text-base-content/70 mt-1">Find the best motorcycle based on your budget</p>
                    </div>
                    <a class="btn btn-ghost btn-sm" href="{{ route('user.dashboard') }}">
                        <x-lucide-arrow-left class="w-4 h-4 mr-1" />
                        Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h3 class="card-title text-lg mb-6">Set Your Budget Range</h3>
                
                @if($errors->any())
                    <div class="alert alert-error mb-4">
                        <x-lucide-alert-circle class="w-6 h-6" />
                        <div>
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('user.moora.calculate') }}">
                    @csrf
                    
                    <div class="form-control mb-6">
                        <label class="label">
                            <span class="label-text font-medium">Budget Range (Rp)</span>
                            <span class="label-text-alt">
                                Available: {{ number_format($minBudget, 0, ',', '.') }} - {{ number_format($maxBudget, 0, ',', '.') }}
                            </span>
                        </label>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="label">
                                    <span class="label-text">Minimum Budget</span>
                                </label>
                                <input type="number" 
                                       name="budget_min" 
                                       class="input input-bordered w-full" 
                                       placeholder="{{ number_format($minBudget, 0, ',', '.') }}"
                                       value="{{ old('budget_min') ?? $minBudget }}"
                                       min="{{ $minBudget }}"
                                       max="{{ $maxBudget }}"
                                       required>
                            </div>
                            
                            <div>
                                <label class="label">
                                    <span class="label-text">Maximum Budget</span>
                                </label>
                                <input type="number" 
                                       name="budget_max" 
                                       class="input input-bordered w-full" 
                                       placeholder="{{ number_format($maxBudget, 0, ',', '.') }}"
                                       value="{{ old('budget_max') ?? $maxBudget }}"
                                       min="{{ $minBudget }}"
                                       max="{{ $maxBudget }}"
                                       required>
                            </div>
                        </div>
                    </div>

                    <div class="card bg-base-200 mb-6">
                        <div class="card-body p-4">
                            <h4 class="font-medium mb-2">Available Motorcycles</h4>
                            <p class="text-sm text-base-content/70">
                                Based on current data, we have Yamaha NMAX and Aerox series available 
                                ranging from <strong>Rp 29.9 juta</strong> to <strong>Rp 46.1 juta</strong>.
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('user.dashboard') }}" class="btn btn-ghost">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <x-lucide-calculator class="w-4 h-4 mr-1" />
                            Analyze Motorcycles
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>