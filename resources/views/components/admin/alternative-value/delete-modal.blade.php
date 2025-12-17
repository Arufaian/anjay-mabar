<dialog class="modal" id="modal_delete_alternative_value_{{ $alternativeValue->id }}">
    <div class="modal-box">
        <h3 class="font-bold text-lg flex items-center gap-2">
            <x-lucide-alert-triangle class="w-5 h-5 text-error" />
            Delete Alternative Value Confirmation
        </h3>

        <div class="py-4">
            <p class="text-base-content/80 mb-4">
                Are you sure you want to delete this alternative value? This action cannot be undone.
            </p>

            <div class="bg-base-300 rounded-lg p-4">
                <div class="space-y-3">
                    <!-- Alternative Info -->
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center">
                            <x-lucide-motorbike class="w-6 h-6 text-primary" />
                        </div>
                        <div>
                            <p class="font-semibold">{{ $alternativeValue->alternative->name }}</p>
                            <p class="text-sm text-base-content/70">{{ $alternativeValue->alternative->code }}</p>
                            <div class="mt-1">
                                @switch($alternativeValue->alternative->type)
                                    @case('matic')
                                        <x-badge color="primary" size="sm">Matic</x-badge>
                                    @break

                                    @case('maxi series')
                                        <x-badge color="warning" size="sm">Maxi</x-badge>
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
                                        <x-badge color="ghost" size="sm">{{ ucfirst($alternativeValue->alternative->type) }}</x-badge>
                                @endswitch
                            </div>
                        </div>
                    </div>

                    <!-- Criteria Info -->
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-lg bg-secondary/10 flex items-center justify-center">
                            <x-lucide-list-checks class="w-6 h-6 text-secondary" />
                        </div>
                        <div>
                            <p class="font-semibold">{{ $alternativeValue->criteria->name }}</p>
                            <p class="text-sm text-base-content/70">{{ $alternativeValue->criteria->code }}</p>
                            <div class="mt-1">
                                @if ($alternativeValue->criteria->type)
                                    <x-badge color="outline" size="sm">{{ $alternativeValue->criteria->type }}</x-badge>
                                @endif
                                @if ($alternativeValue->criteria->unit)
                                    <x-badge color="ghost" size="sm">{{ $alternativeValue->criteria->unit }}</x-badge>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Current Value -->
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-lg bg-accent/10 flex items-center justify-center">
                            <x-lucide-target class="w-6 h-6 text-accent" />
                        </div>
                        <div>
                            <p class="font-semibold">Current Value</p>
                            <p class="text-2xl font-bold text-accent">
                                {{ number_format($alternativeValue->value, $alternativeValue->value == floor($alternativeValue->value) ? 0 : 2) }}
                                @if ($alternativeValue->criteria->unit)
                                    <span class="text-sm text-base-content/60">{{ $alternativeValue->criteria->unit }}</span>
                                @endif
                            </p>
                            @if ($alternativeValue->notes)
                                <p class="text-sm text-base-content/70 mt-1">{{ $alternativeValue->notes }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-warning mt-4">
                <x-lucide-alert-triangle class="w-4 h-4" />
                <div>
                    <p class="font-semibold">Warning: Permanent Deletion</p>
                    <p class="text-sm">This alternative value will be permanently deleted and cannot be recovered.</p>
                </div>
            </div>
        </div>

        <div class="modal-action">
            <form class="inline" method="POST" action="{{ route('admin.alternative-value.destroy', $alternativeValue->id) }}">
                @csrf
                @method('DELETE')

                <div class="flex gap-2">

                    <button class="btn btn-secondary" type="button"
                        onclick="modal_delete_alternative_value_{{ $alternativeValue->id }}.close()">Cancel</button>
                    <button class="btn btn-error text-base-100" type="submit">
                        <x-lucide-trash-2 class="w-4 h-4" />
                        Delete Value
                    </button>

                </div>

            </form>
        </div>
    </div>
    <form class="modal-backdrop" method="dialog">
        <button>close</button>
    </form>
</dialog>