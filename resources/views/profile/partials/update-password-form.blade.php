<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-base-content/50">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <fieldset class="fieldset">
            <legend class="fieldset-legend">{{ __('Current Password') }}</legend>
            <input id="update_password_current_password" name="current_password" type="password" class="input input-bordered w-full mt-1" autocomplete="current-password" />
            @foreach ($errors->updatePassword->get('current_password') ?? [] as $message)
                <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
            @endforeach
        </fieldset>

        <fieldset class="fieldset">
            <legend class="fieldset-legend">{{ __('New Password') }}</legend>
            <input id="update_password_password" name="password" type="password" class="input input-bordered w-full mt-1" autocomplete="new-password" />
            @foreach ($errors->updatePassword->get('password') ?? [] as $message)
                <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
            @endforeach
        </fieldset>

        <fieldset class="fieldset">
            <legend class="fieldset-legend">{{ __('Confirm Password') }}</legend>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="input input-bordered w-full mt-1" autocomplete="new-password" />
            @foreach ($errors->updatePassword->get('password_confirmation') ?? [] as $message)
                <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
            @endforeach
        </fieldset>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
