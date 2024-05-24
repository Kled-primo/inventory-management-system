<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $roles = Role::all()->pluck('name', 'name');

        $users = User::all()->pluck('name', 'id');

        $userroles = User::with('roles')->get();

        return view('permissions.index')
            ->with('roles', $roles)
            ->with('users', $users)
            ->with('userroles', $userroles);
    }

    public function create(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        $user->assignRole($request->role);

        toast('Role Added Success', 'success');

        return redirect()->route('permissions.index');

    }

    public function userremove(Request $request, $user_id)
    {
        $request->validate([
            'role' => 'required|string|exists:roles,name',
        ]);

        $user = User::findOrFail($user_id);

        $user->removeRole($request->role);

        toast('Role Removed Success', 'success');

        return redirect()->route('permissions.index');

    }
}
