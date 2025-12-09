<dialog class="modal" id="modal_delete_user_{{ $user->id }}">
    <div class="modal-box">
        <h3 class="font-bold text-lg flex items-center gap-2">
            <x-lucide-alert-triangle class="w-5 h-5 text-error" />
            Delete User Confirmation
        </h3>
        
        <div class="py-4">
            <p class="text-base-content/80 mb-4">
                Are you sure you want to delete this user? This action cannot be undone.
            </p>
            
            <div class="bg-base-200 rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <div class="avatar avatar-placeholder">
                        <div class="bg-neutral text-neutral-content w-12 rounded-full">
                            <span>{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                        </div>
                    </div>
                    <div>
                        <p class="font-semibold">{{ $user->name }}</p>
                        <p class="text-sm text-base-content/70">{{ $user->email }}</p>
                        <div class="mt-1">
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
                        </div>
                    </div>
                </div>
            </div>
            
            @if($user->role === 'owner')
                <div class="alert alert-error mt-4">
                    <x-lucide-shield-x class="w-4 h-4" />
                    <div>
                        <p class="font-semibold">Cannot Delete Owner</p>
                        <p class="text-sm">Owner users cannot be deleted for system security.</p>
                    </div>
                </div>
            @endif
        </div>
        
        <div class="modal-action">
            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="inline">
                @csrf
                @method('DELETE')
                <button type="button" class="btn" onclick="modal_delete_user_{{ $user->id }}.close()">Cancel</button>
                <button 
                    type="submit" 
                    class="btn btn-error"
                    @if($user->role === 'owner') disabled
                    @endif
                >
                    <x-lucide-trash-2 class="w-4 h-4 mr-2" />
                    Delete User
                </button>
            </form>
        </div>
    </div>
    <form class="modal-backdrop" method="dialog">
        <button>close</button>
    </form>
</dialog>