<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password (Hardcoded DaisyUI Fieldset) -->
        <fieldset class="fieldset mt-4">
            <legend class="fieldset-legend">{{ __('Password') }}</legend>
            <input id="password" name="password" type="password" class="input mt-1 w-full" placeholder="{{ __('Enter your password') }}" required autocomplete="current-password" />
            @error('password')
                <p class="label text-error">{{ $message }}</p>
            @enderror
        </fieldset>

        <div class="flex justify-end mt-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Confirm') }}
            </button>
        </div>
    </form>
</x-guest-layout>
