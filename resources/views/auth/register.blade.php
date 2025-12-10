<x-guest-layout>
    <h2 class="card-title justify-center mb-4">{{ __('Sign up') }}</h2>

    <div class="w-full flex justify-center">

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-control">
                <label class="input validator">
                    <x-lucide-user class="h-[1em] opacity-50" />
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus
                        autocomplete="name" placeholder="Full Name" />
                </label>
                <div class="validator-hint hidden">Enter your full name</div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="form-control mt-4">
                <label class="input validator">
                    <x-lucide-mail class="h-[1em] opacity-50" />
                    <input id="email" type="email" name="email" :value="old('email')" required
                        autocomplete="username" placeholder="mail@site.com" />
                </label>
                <div class="validator-hint hidden">Enter valid email address</div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-control mt-4">
                <label class="input validator">
                    <x-lucide-lock class="h-[1em] opacity-50" />
                    <input name="password" id="password" type="password" required placeholder="Password" minlength="8" />
                </label>
                <div class="validator-hint hidden">Must be at least 8 characters</div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="form-control mt-4">
                <label class="input validator">
                    <x-lucide-lock class="h-[1em] opacity-50" />
                    <input name="password_confirmation" id="password_confirmation" type="password" required
                        placeholder="Confirm Password" minlength="8" />
                </label>
                <div class="validator-hint hidden">Must be at least 8 characters</div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="form-control mt-6 w-full">
                <button type="submit" class="btn btn-primary w-full">
                    {{ __('Register') }}
                </button>
            </div>


            <div class="form-control mt-6 w-full">
                <a href="{{ route('login') }}" class="btn btn-soft w-full">
                    {{ __('Have an account? Log in') }}
                </a>
            </div>



        </form>

    </div>

</x-guest-layout>
