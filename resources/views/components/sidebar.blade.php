<aside class="drawer-side is-drawer-close:overflow-visible">
    <label class="drawer-overlay" for="my-drawer-4" aria-label="close sidebar"></label>
    <div class="flex min-h-full flex-col items-start bg-base-100 is-drawer-close:w-14 is-drawer-open:w-64">
        <!-- Sidebar content here -->

        <div class="w-full justify-center border-b border-base-300 pb-2 my-2">
            <ul>
                <li>
                    <a class=" is-drawer-open:mx-auto flex justify-center" data-tip="Dashboard" href="/">
                        <x-application-logo
                            class=" inline-block h-10 w-10 my-1 is-drawer-open:p-0 is-drawer-close:p-2 fill-error" />
                    </a>
                </li>
            </ul>
        </div>

        <div class="menu w-full grow">
            <ul>
                <!-- Admin Menu Items -->
                @foreach ($adminMenuItems as $item)
                    <li >
                        <a class="is-drawer-close:tooltip is-drawer-close:tooltip-right py-2 my-2 {{ request()->routeIs($item['route']) ? 'menu-active bg-primary dark:text-base-100' : '' }}" data-tip="{{ $item['name'] }}"
                            href="{{ route($item['route']) }}">
                            <x-dynamic-component class="w-4 h-4" :component="'lucide-' . $item['icon']" />

                            <span class="is-drawer-close:hidden">{{ $item['name'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="w-full p-1">
            <ul>
                <!-- Logout -->
                <li>
                    <form class="w-full" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            class="is-drawer-close:tooltip is-drawer-close:tooltip-right btn btn-outline btn-error w-full text-left"
                            data-tip="Logout" type="submit">
                            <!-- Logout icon -->
                            <x-lucide-log-out class="my-1.5 inline-block size-4" />
                            <span class="is-drawer-close:hidden">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </div>
</aside>
