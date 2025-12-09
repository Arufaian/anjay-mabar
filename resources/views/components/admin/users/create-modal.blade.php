<dialog class="modal" id="modal_create_user">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">Add New User</h3>
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="grid gap-2">
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Name</legend>
                    <input 
                        class="input w-full @error('name') input-error @enderror" 
                        name="name" 
                        type="text" 
                        placeholder="Enter user's full name"
                        value="{{ old('name') }}"
                        required 
                    />
                    @error('name')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="label">Required</p>
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Email</legend>
                    <input 
                        class="input w-full @error('email') input-error @enderror" 
                        name="email" 
                        type="email" 
                        placeholder="Enter user's email address"
                        value="{{ old('email') }}"
                        required 
                    />
                    @error('email')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="label">Required - Must be unique</p>
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Password</legend>
                    <input 
                        class="input w-full @error('password') input-error @enderror" 
                        name="password" 
                        type="password" 
                        placeholder="Enter password"
                        required 
                    />
                    @error('password')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="label">Required - Minimum 8 characters</p>
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Confirm Password</legend>
                    <input 
                        class="input w-full @error('password_confirmation') input-error @enderror" 
                        name="password_confirmation" 
                        type="password" 
                        placeholder="Confirm password"
                        required 
                    />
                    @error('password_confirmation')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="label">Required - Must match password</p>
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Role</legend>
                    <select class="select w-full @error('role') select-error @enderror" name="role" required>
                        <option value="">Select Role</option>
                        <option value="admin" @selected(old('role') === 'admin')>Admin</option>
                        <option value="user" @selected(old('role') === 'user')>User</option>
                        @if (isset($hasOwner) && !$hasOwner)
                            <option value="owner" @selected(old('role') === 'owner')>Owner</option>
                        @endif
                    </select>
                    @error('role')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="label">Required</p>
                    @if (isset($hasOwner) && $hasOwner)
                        <p class="text-warning text-sm mt-1">
                            <x-lucide-alert-triangle class="w-4 h-4 inline mr-1" />
                            Owner role is not available (already exists)
                        </p>
                    @endif
                </fieldset>
            </div>
            <div class="modal-action">
                <button class="btn" type="button" onclick="modal_create_user.close()">Cancel</button>
                <button class="btn btn-primary" type="submit">Create User</button>
            </div>
        </form>
    </div>
    <form class="modal-backdrop" method="dialog">
        <button>close</button>
    </form>
</dialog>