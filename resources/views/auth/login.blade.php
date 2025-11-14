<x-guest-layout>
    <h2 class="card-title justify-center mb-4">{{ __('Log in') }}</h2>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full flex justify-center">

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-control">

                <label class="input validator">

                    <x-lucide-mail class="h-[1em] opacity-50" />

                    <input id="email" type="email" name="email" :value="old('email')" required
                        placeholder="mail@site.com" required />


                </label>
                <div class="validator-hint hidden">Enter valid email address</div>
                <x-input-error :messages="$errors->get('email')" autocomplete="username" class="mt-2" />

            </div>

            <!-- Password -->
            <div class="form-control mt-4">
                <label class="input validator">

                    <x-lucide-lock class="h-[1em] opacity-50" />
                    <input name="password" id="password" type="password" required placeholder="Password" minlength="8"
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                        title="Must be more than 8 characters, including number, lowercase letter, uppercase letter" />
                </label>
                <p class="validator-hint hidden">
                    Must be more than 8 characters, including
                    <br />At least one number <br />At least one lowercase letter <br />At least one uppercase letter
                </p>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

            </div>

            <!-- Remember Me -->
            <div class="form-control mt-4">
                <label class="label cursor-pointer">
                    <input id="remember_me" type="checkbox" class="checkbox" name="remember" />
                    <span class="label-text ml-2">{{ __('Remember me') }}</span>
                </label>
            </div>


            <div class="flex gap-4 justify-between">
                <div class="form-control mt-6 w-full">
                    <a href="{{ route('register') }}" class="btn btn-secondary w-full">
                        Sign up
                    </a>
                </div>

                <div class="form-control mt-6 w-full">
                    <button type="submit" class="btn btn-primary w-full">
                        {{ __('Log in') }}
                    </button>
                </div>
            </div>




            @if (Route::has('password.request'))
                <div class="flex justify-center mt-4">
                    <a class="btn btn-soft w-full font-normal" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                </div>
            @endif
        </form>

    </div>

</x-guest-layout>
