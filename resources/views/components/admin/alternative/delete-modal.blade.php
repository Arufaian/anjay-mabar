<dialog class="modal" id="modal_delete_alternative_{{ $alternative->id }}">
    <div class="modal-box">
        <h3 class="font-bold text-lg flex items-center gap-2">
            <x-lucide-alert-triangle class="w-5 h-5 text-error" />
            Delete Alternative Confirmation
        </h3>

        <div class="py-4">
            <p class="text-base-content/80 mb-4">
                Are you sure you want to delete this alternative? This action cannot be undone.
            </p>

            <div class="bg-base-300 rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center">
                        <x-lucide-motorbike class="w-6 h-6 text-primary" />
                    </div>
                    <div>
                        <p class="font-semibold">{{ $alternative->name }}</p>
                        <p class="text-sm text-base-content/70">{{ $alternative->code }}</p>
                        <div class="mt-1">
                            <x-badge color="primary" size="sm">{{ ucfirst($alternative->type) }}</x-badge>
                            @if ($alternative->year)
                                <x-badge color="outline" size="sm">{{ $alternative->year }}</x-badge>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if ($alternative->alternativeValues->count() > 0)
                <div class="alert alert-warning mt-4">
                    <x-lucide-alert-triangle class="w-4 h-4" />
                    <div>
                        <p class="font-semibold">Warning: Has Criteria Values</p>
                        <p class="text-sm">This alternative has {{ $alternative->alternativeValues->count() }} criteria
                            values that will also be deleted.</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="modal-action">
            <form class="inline" method="POST" action="{{ route('admin.alternative.destroy', $alternative->id) }}">
                @csrf
                @method('DELETE')

                <div class="flex gap-2">

                    <button class="btn btn-secondary" type="button"
                        onclick="modal_delete_alternative_{{ $alternative->id }}.close()">Cancel</button>
                    <button class="btn btn-error text-base-100" type="submit">
                        <x-lucide-trash-2 class="w-4 h-4" />
                        Delete Alternative
                    </button>

                </div>

            </form>
        </div>
    </div>
    <form class="modal-backdrop" method="dialog">
        <button>close</button>
    </form>
</dialog>
