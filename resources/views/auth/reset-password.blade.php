<x-guest-layout>
    <h2 class="card-title justify-center mb-4">{{ __('Reset Password') }}</h2>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full flex justify-center">

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="form-control">
                <label class="input validator">
                    <x-lucide-mail class="h-[1em] opacity-50" />
                    <input id="email" type="email" name="email" :value="old('email', $request->email)" required
                        placeholder="mail@site.com" required autofocus autocomplete="username" />
                </label>
                <div class="validator-hint hidden">Enter valid email address</div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-control mt-4">
                <label class="input validator">
                    <x-lucide-lock class="h-[1em] opacity-50" />
                    <input name="password" id="password" type="password" required placeholder="Password" minlength="8"
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                        title="Must be more than 8 characters, including number, lowercase letter, uppercase letter" autocomplete="new-password" />
                </label>
                <p class="validator-hint hidden">
                    Must be more than 8 characters, including
                    <br />At least one number <br />At least one lowercase letter <br />At least one uppercase letter
                </p>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="form-control mt-4">
                <label class="input validator">
                    <x-lucide-lock class="h-[1em] opacity-50" />
                    <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Confirm Password" minlength="8"
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                        title="Must be more than 8 characters, including number, lowercase letter, uppercase letter" autocomplete="new-password" />
                </label>
                <p class="validator-hint hidden">
                    Must be more than 8 characters, including
                    <br />At least one number <br />At least one lowercase letter <br />At least one uppercase letter
                </p>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="form-control mt-6 w-full">
                <button type="submit" class="btn btn-primary w-full">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>

    </div>

</x-guest-layout>
