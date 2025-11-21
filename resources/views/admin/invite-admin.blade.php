<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">Promosi Karyawan ke Admin</h2>
    </x-slot>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-base-100">
                <div class="p-6 ">

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.invite', $user) }}">
                                            @csrf
                                            @method('patch')

                                            <button class="btn btn-sm btn-primary" type="submit">
                                                Jadikan Admin
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
