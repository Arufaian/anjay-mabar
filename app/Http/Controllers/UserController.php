<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->input('role'));
        }

        // Filter by verification status
        if ($request->filled('verified')) {
            if ($request->input('verified') == '1') {
                $query->whereNotNull('email_verified_at');
            } else {
                $query->whereNull('email_verified_at');
            }
        }

        $users = $query->paginate(10);

        // Check if owner exists for modal
        $hasOwner = User::where('role', 'owner')->exists();

        return view('admin.users.index', compact('users', 'hasOwner'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        try {
            // Hash the password
            $validated['password'] = Hash::make($validated['password']);

            // Auto-verify email for admin-created users
            $validated['email_verified_at'] = now();

            $user = User::create($validated);

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'User created successfully.');
        } catch (QueryException $e) {
            // Handle database errors
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['database' => 'Database error: Unable to create user. Please try again.']);
        } catch (\Exception $e) {
            // Handle other exceptions
            Log::error('User creation failed: '.$e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['general' => 'An error occurred while creating the user. Please try again.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $hasOwner = User::where('role', 'owner')->exists();

        return view('admin.users.edit', compact('user', 'hasOwner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validated();

        // Check if trying to set role to owner when owner already exists
        if (isset($validated['role']) && $validated['role'] === 'owner') {
            $existingOwner = User::where('role', 'owner')->where('id', '!=', $user->id)->first();
            if ($existingOwner) {
                return redirect()
                    ->back()
                    ->withErrors(['role' => 'An owner already exists in the system.'])
                    ->withInput();
            }
        }

        // Only update password if provided
        if (isset($validated['password']) && ! empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Prevent deletion of the last owner
        if ($user->role === 'owner') {
            return redirect()
                ->route('admin.users.index')
                ->withErrors(['delete' => 'Cannot delete the owner user.']);
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
