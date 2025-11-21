<x-app-layout>

    <x-slot name="header">
        <div class="breadcrumbs text-sm">
            <ul>
                <li>
                    <a>
                        <svg class="h-4 w-4 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <a>
                        <svg class="h-4 w-4 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                        </svg>
                        Documents
                    </a>
                </li>
                <li>
                    <span class="inline-flex items-center gap-2">
                        <svg class="h-4 w-4 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Add Document
                    </span>
                </li>
            </ul>
        </div>
    </x-slot>

    <div class="sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div
                class="card bg-base-100 shadow-sm hover:-translate-y-1.5 hover:shadow-md hover:shadow-primary transition duration-200">
                <div class="stat">
                    <div class="stat-title">Data user</div>
                    <div class="stat-value">User</div>
                    <div class="stat-desc">
                        <a class="hover:underline hover:text-primary" href="">Selengkapnya</a>
                    </div>
                </div>
            </div>

            <div
                class="card bg-base-100 shadow-sm hover:-translate-y-1.5 hover:shadow-md hover:shadow-primary transition duration-200">
                <div class="stat">
                    <div class="stat-title">Data suplier</div>
                    <div class="stat-value">Suplier</div>
                    <div class="stat-desc">
                        <a class="hover:underline hover:text-primary" href="">Selengkapnya</a>
                    </div>
                </div>
            </div>

            <div
                class="card bg-base-100 shadow-sm hover:-translate-y-1.5 hover:shadow-md hover:shadow-primary transition duration-200">
                <div class="stat">
                    <div class="stat-title">Data Barang</div>
                    <div class="stat-value">Laporan Barang</div>
                    <div class="stat-desc">
                        <a class="hover:underline hover:text-primary" href="#">Selengkapnya</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
