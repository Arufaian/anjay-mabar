<nav class="navbar w-full bg-base-100 border-l border-base-300">

    <div class="flex items-center justify-between w-full px-4">

        <label class="btn btn-square btn-ghost" for="my-drawer-4" aria-label="open sidebar">
            <x-lucide-menu class="h-6 w-6" />
        </label>

        <div class="flex items-center gap-4">

            <x-theme-swapper />

            <div class="avatar avatar-placeholder dropdown dropdown-end dropdown-bottom cursor-pointer">
                <div class="bg-secondary text-neutral-content w-10 rounded-full" role="button" tabindex="0">
                    <span>SY</span>
                </div>

                <ul class="dropdown-content menu bg-base-200 rounded-box w-40 shadow-sm mt-2" tabindex="-1">
                    <li>
                        <a class="flex justify-center items-center" href="{{ route('profile.edit') }}">
                            <x-lucide-user class="w-4 h-4" />
                            <span>Profile</span>
                        </a>
                    </li>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <li>
                            <a class="flex justify-center items-center" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                <x-lucide-log-out class="w-4 h-4" />
                                <span>Logout</span>
                            </a>
                        </li>

                    </form>

                </ul>
            </div>

        </div>

    </div>

</nav>
