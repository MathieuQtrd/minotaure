<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::all();
        $users = User::orderBy('name', 'asc')->get();
        $roles = Role::all();

        return view('admin.users.index', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id); // on récupère le user concerné ou Null
        $role = $request->input('role');

        if($role && Role::where('name', $role)->exists()) {
            $user->syncRoles([$role]);
            return redirect()->route('admin.users.index')->with('success', 'Rôle mis à jour avec succès.');
        }

        return redirect()->route('admin.users.index')->with('error', 'Le rôle sélectionné est invalide.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user) {
            $name = $user->name;
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'L\'utilisateur ' . $name . ' a bien été supprimé.');
        }
        return redirect()->route('admin.users.index')->with('error', 'L\'utilisateur concerné n\'est pas présent dans la liste des utilisateurs enregistrés.');
    }

    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', [
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole($validated['role']);

        return redirect()->route('admin.users.index')->with('success', 'Nouvel utilisateur créé.');
    }
}
