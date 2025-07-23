<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; // ORM de Laravel

class Contact extends Model
{
    //
    protected $fillable = ['name', 'email', 'message'];  // colonnes pouvant être remplies par le formulaire
}
