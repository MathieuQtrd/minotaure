<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', [
            'permissions' => $permissions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:permissions',
        ]);

        Permission::create([
            'name' => $validated['name'],
        ]);

        return redirect()->route('admin.permissions.index')->with('success', 'Nouvelle permission créée.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);
        if($permission) {
            $name = $permission->name;
            $permission->delete();
            return redirect()->route('admin.permissions.index')->with('success', 'La permission ' . $name . ' a bien été supprimée.');
        }
        return redirect()->route('admin.permissions.index')->with('error', 'La permission concernée n\'est pas présente dans la liste des permissions enregistrées.');
    }
}
