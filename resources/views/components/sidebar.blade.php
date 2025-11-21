<aside class="drawer-side is-drawer-close:overflow-visible">
    <label class="drawer-overlay" for="my-drawer-4" aria-label="close sidebar"></label>
    <div class="flex min-h-full flex-col items-start bg-base-100 is-drawer-close:w-14 is-drawer-open:w-64">
        <!-- Sidebar content here -->
        <ul class="menu w-full grow">
            <!-- Dashboard -->
            <li>
                <a class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Dashboard"
                    href="{{ route('dashboard') }}">
                    <!-- Dashboard icon -->

                    <x-lucide-layout-dashboard class="my-1.5 inline-block size-4" />
                    <span class="is-drawer-close:hidden">Dashboard</span>
                </a>
            </li>

            <!-- Profile -->
            <li>
                <a class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Profile"
                    href="{{ route('profile.edit') }}">
                    <!-- Profile icon -->
                    <x-lucide-user-pen class="my-1.5 inline-block size-4" />
                    <span class="is-drawer-close:hidden">Profile</span>
                </a>
            </li>

            <!-- Logout -->
            <li>
                <form class="w-full" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="is-drawer-close:tooltip is-drawer-close:tooltip-right w-full text-left"
                        data-tip="Logout" type="submit">
                        <!-- Logout icon -->
                        <x-lucide-log-out class="my-1.5 inline-block size-4" />
                        <span class="is-drawer-close:hidden">Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
