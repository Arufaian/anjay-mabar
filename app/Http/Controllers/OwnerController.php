<?php

namespace App\Http\Controllers;

use App\Models\User;

class OwnerController extends Controller
{
    public function listUsers()
    {
        $users = User::with('roles')->get();

        return view('owner.list-users', compact('users'));
    }
}
