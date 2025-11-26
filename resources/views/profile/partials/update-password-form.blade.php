<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-base-content/50">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form class="mt-6 space-y-6" method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <fieldset class="fieldset">
            <legend class="fieldset-legend">{{ __('Current Password') }}</legend>
            <input class="input input-bordered w-full mt-1" id="update_password_current_password" name="current_password"
                type="password" autocomplete="current-password" />
            @foreach ($errors->updatePassword->get('current_password') ?? [] as $message)
                <span class="text-error text-sm mt-2">{{ $message }}</span>
            @endforeach
        </fieldset>

        <fieldset class="fieldset">
            <legend class="fieldset-legend">{{ __('New Password') }}</legend>
            <input class="input input-bordered w-full mt-1" id="update_password_password" name="password"
                type="password" autocomplete="new-password" />
            @foreach ($errors->updatePassword->get('password') ?? [] as $message)
                <span class="text-error text-sm mt-2">{{ $message }}</span>
            @endforeach
        </fieldset>

        <fieldset class="fieldset">
            <legend class="fieldset-legend">{{ __('Confirm Password') }}</legend>
            <input class="input input-bordered w-full mt-1" id="update_password_password_confirmation"
                name="password_confirmation" type="password" autocomplete="new-password" />
            @foreach ($errors->updatePassword->get('password_confirmation') ?? [] as $message)
                <span class="text-error text-sm mt-2">{{ $message }}</span>
            @endforeach
        </fieldset>

        <div class="flex items-center gap-4">
            <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>

            @if (session('status') === 'password-updated')
                <x-toast>
                    <x-slot name="alert">
                        <x-alert type="success" :title="__('Success')" :message="__('Profile updated successfully.')">
                            <x-slot name="icon">
                                <x-lucide-check-circle class="w-5 h-5" />
                            </x-slot>
                        </x-alert>
                    </x-slot>
                </x-toast>
            @endif
        </div>
    </form>
</section>
