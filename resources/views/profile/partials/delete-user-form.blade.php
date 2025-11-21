<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-neutral">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-neutral/50">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <!-- DaisyUI modal trigger -->
    <label for="confirm-user-deletion" class="btn btn-error">{{ __('Delete Account') }}</label>

    <input id="confirm-user-deletion" type="checkbox" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box p-6">
            <form method="post" action="{{ route('profile.destroy') }}" class="w-full">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-neutral mb-2">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-1 text-sm text-neutral/50 mb-4">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-4">
                    <label for="password" class="sr-only">{{ __('Password') }}</label>
                    <input id="password" name="password" type="password" class="input input-bordered w-full" placeholder="{{ __('Password') }}" />
                    @foreach ($errors->userDeletion->get('password') ?? [] as $message)
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @endforeach
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <label for="confirm-user-deletion" class="btn">{{ __('Cancel') }}</label>
                    <button type="submit" class="btn btn-error">{{ __('Delete Account') }}</button>
                </div>
            </form>
        </div>
    </div>
</section>
