<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $employees = User::role('karyawan')->get();

        return view('admin.invite-admin', compact('employees'));
    }

    public function inviteAdmin(User $user)
    {

        $user->removeRole('karyawan');

        $user->assignRole('admin');

        if ($user->hasRole('admin')) {

            return back()->with('status', 'Pengguna '.$user->name.' berhasil dipromosikan menjadi Admin.');
        }

    }

    public function userManagement()
    {
        $users = User::all();

        return view('admin.user-management.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,karyawan,owner',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return back()->with('status', 'User created successfully.');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'role' => 'required|string|in:admin,karyawan,owner',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->syncRoles([$request->role]);

        return back()->with('status', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('status', 'User deleted successfully.');
    }
}
