<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Spatie\Permission\Models\Role;

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
}
