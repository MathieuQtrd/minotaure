<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = ['name', 'description', 'user_id', 'project_id', 'status', 'priority'];

    // relation ManyToOne
    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class);
        // laravel fait le lien naturelllement avec la table projects et la clé primaire id car convention respectée (le nom de la clé étrangère : {model}_id)
        // $task->projects() : nous renvoie le projet lié
    }

    // relation ManyToOne
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
        // laravel fait le lien naturelllement avec la table projects et la clé primaire id car convention respectée (le nom de la clé étrangère : {model}_id)
        // $task->projects() : nous renvoie l'utilisateur affecté à cette tache
    }
}
