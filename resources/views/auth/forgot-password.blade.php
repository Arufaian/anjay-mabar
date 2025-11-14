<x-guest-layout>
    <h2 class="card-title justify-center mb-4">{{ __('Forgot Password') }}</h2>

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full flex justify-center">

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-control">
                <label class="input validator">
                    <x-lucide-mail class="h-[1em] opacity-50" />
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="mail@site.com" />
                </label>
                <div class="validator-hint hidden">Enter valid email address</div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="form-control mt-6 w-full">
                <button type="submit" class="btn btn-primary w-full">
                    {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </form>

    </div>
</x-guest-layout>
