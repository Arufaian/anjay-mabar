<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" bg-base-100 overflow-hidden shadow-sm">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Users</h3>
                        <button class="btn btn-primary" onclick="addModal.showModal()">Add User</button>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="table table-zebra w-full">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                <span class="badge badge-primary">{{ $role->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-warning"
                                                onclick="editModal.showModal(); setEditData({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->roles->first()->name ?? '' }}')">Edit</button>
                                            <form class="inline" method="POST"
                                                action="{{ route('admin.user-management.destroy', $user) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-error" type="submit">Delete</button>
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
    </div>

    <!-- Add User Modal -->
    <dialog class="modal" id="addModal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Add New User</h3>
            <form method="POST" action="{{ route('admin.user-management.store') }}">
                @csrf
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Name</span>
                    </label>
                    <input class="input input-bordered" name="name" type="text" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input class="input input-bordered" name="email" type="email" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input class="input input-bordered" name="password" type="password" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Confirm Password</span>
                    </label>
                    <input class="input input-bordered" name="password_confirmation" type="password" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Role</span>
                    </label>
                    <select class="select select-bordered" name="role" required>
                        <option value="karyawan">Karyawan</option>
                        <option value="admin">Admin</option>
                        <option value="owner">Owner</option>
                    </select>
                </div>
                <div class="modal-action">
                    <button class="btn btn-primary" type="submit">Create</button>
                    <button class="btn" type="button" onclick="addModal.close()">Cancel</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Edit User Modal -->
    <dialog class="modal" id="editModal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Edit User</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Name</span>
                    </label>
                    <input class="input input-bordered" id="editName" name="name" type="text" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input class="input input-bordered" id="editEmail" name="email" type="email" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Role</span>
                    </label>
                    <select class="select select-bordered" id="editRole" name="role" required>
                        <option value="karyawan">Karyawan</option>
                        <option value="admin">Admin</option>
                        <option value="owner">Owner</option>
                    </select>
                </div>
                <div class="modal-action">
                    <button class="btn btn-primary" type="submit">Update</button>
                    <button class="btn" type="button" onclick="editModal.close()">Cancel</button>
                </div>
            </form>
        </div>
    </dialog>

    <script>
        function setEditData(id, name, email, role) {
            document.getElementById('editForm').action = '{{ url('admin/user-management') }}/' + id;
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editRole').value = role;
        }
    </script>
</x-app-layout>
