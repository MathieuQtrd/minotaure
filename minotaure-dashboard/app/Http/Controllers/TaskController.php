<?php

namespace App\Http\Controllers;

use App\Models\task;
use App\Models\User;
use App\Models\project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        // dd($project->id);
        // Création de la tâche
        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
            'project_id' => $project->id,
        ]);
    
        return redirect()->route('developpeur.project.show', $project)->with('success', 'Tâche créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(task $task)
    {
        //
    }
}
