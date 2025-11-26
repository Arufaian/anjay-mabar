<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-base-content/50">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form class="mt-6 space-y-6" method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <fieldset class="fieldset">
            <legend class="fieldset-legend">{{ __('Name') }}</legend>
            <input class="input input-bordered w-full mt-1" id="name" name="name" type="text"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')
                <span class="text-error text-sm mt-2">{{ $message }}</span>
            @enderror
        </fieldset>

        <fieldset class="fieldset">
            <legend class="fieldset-legend">{{ __('Email') }}</legend>
            <input class="input input-bordered w-full mt-1" id="email" name="email" type="email"
                value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email')
                <span class="text-error text-sm mt-2">{{ $message }}</span>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-base-content/50">
                        {{ __('Your email address is unverified.') }}

                        <button
                            class="underline text-sm text-base-content/50 hover:text-base-content rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                            form="send-verification">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-success">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </fieldset>

        <div class="flex items-center gap-4">
            <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
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
