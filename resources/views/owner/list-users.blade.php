<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="overflow-hidden shadow-sm">
                <div class="p-6 bg-base-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y ">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">Name
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">Email
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">Role
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                        Created At</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-base-300">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm ">{{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm ">
                                            {{ $user->roles->pluck('name')->join(', ') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm ">
                                            {{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
