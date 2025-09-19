<?php 

# laravel new mon_api
    // starter pack none
# cd mon_api 

// installation de sanctum : 
# php artisan install:api

// installation de Spatie :
# composer require spatie/laravel-permission
# php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

// Création du fichier CORS
# php artisan config:publish cors

// Ne pas oublier le middleware de Spatie dans bootstrap/app.php

// Dans le model User.php rajouter l'utilisation des token de l'api et de Spatie
// Models/User.php
// ...
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
// ...

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasApiTokens;
    // ...
}

// Création d'un controller pour login / register / logout / ...
# php artisan make:controller AuthController

// Mise en place des routes sur routes/api.php 

// etc ...