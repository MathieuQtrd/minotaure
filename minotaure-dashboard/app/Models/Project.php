<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'creator_id', 'client_id', 'status'];

    // ManyToOne
    public function creator() : BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');

        // $project->creator() : nous renverra le créateur du projet
    }

    // ManyToOne
    public function client() : BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');

        // $project->client() : nous renverra le client du projet
    }

    // OneToMany
    public function tasks() : HasMany
    {
        return $this->hasMany(Task::class);

        // $project->task() : nous renverra la liste des taches du projet
    }

    // ManyToMany
    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class);
        // return $this->belongsToMany(User::class, 'project_user'); // possible mais pas necessaire

        // ici on se refere à la table project_user car la convention d'écriture de la table est respectée (nom des tables au singulier)
        // Si la table s'appelait project_developer, il faudrait la préciser : 
        // return $this->belongsToMany(User::class, 'project_developer');

        // $project->users() : nous renverra la liste des utilisateurs du projet
    }


    // Affecter un user à un projet
    public function addUser(User $user)
    {
        // pour mettre la relation sur la table pivot : attach()
        $this->users()->attach($user->id);
    }

    // Enlever un user à un projet
    public function removeUser(User $user)
    {
        // pour enlever la relation sur la table pivot : detach()
        $this->users()->detach($user->id);
    }

    // Valider un projet
    public function validateProject()
    {
        $this->status = 'terminé';
        $this->save(); // permet de créer ou modifier une entrée de la bdd
    }

}
