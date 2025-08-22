<?php

namespace App\Http\Controllers;

use App\Models\project;
use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $user = auth()->user();
        // $user = Auth::user(); // Rajouter le use Illuminate\Support\Facades\Auth;
        // $user = User::find(auth()->id());

        if($user->hasRole('admin')) {
            $projects = Project::with(['client', 'creator'])->get();
            return view('admin.projects.index', [
                'projects' => $projects,
            ]);
        } elseif($user->hasRole('developpeur')) {
            $projects = $user->projects()->with(['client', 'creator'])->get();
            return view('developpeur.projects.index', [
                'projects' => $projects,
            ]);
        } elseif($user->hasRole('client')) {
            
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = User::role('client')->get();
        $users = User::withoutrole(['client', 'admin'])->get();

        return view('admin.projects.create', ['clients' => $clients, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'client_id' => 'required|exists:users,id',
            'users' => 'nullable|array',
        ]);

        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'client_id' => $request->client_id,
            'creator_id' => auth()->user()->id,
        ]);

        if($request->users) {
            $project->users()->attach($request->users);
        }
        return redirect()->route('admin.projects.index')->with('success', 'Nouveau projet ' . $request->title . ' créé avec succés.');
    }

    /**
     * Display the specified resource.
     */
    public function show(project $project)
    {
        $user = auth()->user();

        if($user->hasRole('admin')) {
            $users_id = [];
            foreach($project->users as $dev) {
                $users_id[] = $dev->id;
            }
            $availableUsers = User::withoutrole(['client', 'admin'])->whereNotIn('id', $users_id)->get();
            return view('admin.projects.show', [
                'project' => $project,
                'availableUsers' => $availableUsers,
            ]);
        } elseif($user->hasRole('developpeur')) {
            return view('developpeur.projects.show', [
                'project' => $project,
            ]);
        } elseif($user->hasRole('client')) {
            
        }
    }

    public function addUser(Request $request, Project $project)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        $user = User::findOrFail($validated['user_id']);

        $project->addUser($user);

        return back()->with('success', 'Nouvel employé ajouté au projet');
    }

    public function removeUser(Project $project, User $user)
    {
        //dd($user);
        // $validated = $request->validate([
        //     'user_id' => 'required|exists:users,id',
        // ]);
        // $user = User::findOrFail($validated['user_id']);

        $project->removeUser($user);
        // $project->users()->detach($user->id);;

        return back()->with('success', 'Employé retiré du projet');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(project $project)
    {
        //
    }
}
