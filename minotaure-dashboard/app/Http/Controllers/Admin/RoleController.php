<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->orderBy('name', 'asc')->get();
        return view('admin.roles.index', [
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles',
        ]);

        Role::create([
            'name' => $validated['name'],
        ]);

        return redirect()->route('admin.roles.index')->with('success', 'Nouveau rôle créé.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.show', [
            'permissions' => $permissions,
            'role' => $role,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        // dump($request);
        $role->syncPermissions([$request->input('permissions')]);
        return redirect()->route('admin.roles.index')->with('success', 'Mise à jour des permissions effectuée.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        if($role) {
            $name = $role->name;
            $role->delete();
            return redirect()->route('admin.roles.index')->with('success', 'Le rôle ' . $name . ' a bien été supprimé.');
        }
        return redirect()->route('admin.roles.index')->with('error', 'Le rôle concerné n\'est pas présent dans la liste des rôles enregistrés.');
    }
}
