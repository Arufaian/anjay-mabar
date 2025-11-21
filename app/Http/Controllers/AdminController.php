<?php

namespace App\Http\Controllers;

use App\Models\User;

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
}
