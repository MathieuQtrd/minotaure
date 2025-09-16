<?php 
//---------------------------------------------------
//---------------------------------------------------
// Etapes du projet API event
//---------------------------------------------------
//---------------------------------------------------
/*
Etapes pour laravel_api_event
- nouvelle installation laravel en choississant le starter kit "none"
laravel new laravel_api_event

- après avoir choisi le SGBD (mysql), aller dans le fichier .env pour rajouter ces lignes (au cas où c'est nécessaire) :
DB_CHARSET=utf8
DB_COLLATION=utf8_general_ci

- On install breeze
cd .\laravel_api_event\
composer require laravel/breeze --dev
php artisan breeze:install
- suivre les étapes avec notamment le choix de blade

- une fois l'installation terminée : npm install puis npm run dev et on change de console
- ensuite php artisan serve et on change de console

- Si vous faites le choix d'utiliser Spatie :
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

- aller dans le dernier fichier de migration (database/migrations/) et changer ces deux éléments (si nécessaire, toujours lié au souci de taille des string selon la version de MySQL) : Sur les deux création des tables roles et permissions

$table->string('name');
$table->string('guard_name');

On change par 

$table->string('name', 225);
$table->string('guard_name', 25);

- php artisan migrate

- Ensuite il faut aller dans le model User Pour rajouter le trait HasRole

use Spatie\Permission\Traits\HasRoles; // à rajouter

class User extends Authenticatable
{
    use HasRoles; // à rajouter
    //...
}

// on crée un seeder pour créer des roles, puis on midfie DatabaseSeeder pour créer 2 comptes
php artisan make:seeder RoleSeeder

// On va dans le fichier database/seeders/RoleSeeder.php et on déclare des rôles, permissions ...
// On va dans le fichier database/seeders/DatabaseSeeder.php et on crée des utilisateur (admin et user1)

// On execute :
php artisan migrate:fresh --seed

// Possibilité de mettre un role user par défaut :
// Dans app/Http/Controllers/Auth/RegisteredUserController.php

// Création du model Event et du fichier de migration (-m)
# php artisan make:model Event -m
// On modifie le fichier de migration

// On crée le controller avec le --ressource afin d'avoir les methodes du crud directement dans le controller

// Mise en place des routes :
Route::resource('events', EventController::class);

// Cela crée les routes suivantes :
// GET	        /admin/events	                admin.events.index
// GET	        /admin/events/create	        admin.events.create
// POST	        /admin/events	                admin.events.store
// GET	        /admin/events/{event}	        admin.events.show
// GET	        /admin/events/{event}/edit	    admin.events.edit
// PUT/PATCH	/admin/events/{event}	        admin.events.update
// DELETE	    /admin/events/{event}	        admin.events.destroy

// On fait les vues


// Rajouter dans tailwind.config.js la ligne suivante si nécessaire pour les classes manquantes de tailwind : 
    ...
    plugins: [forms],
    mode: 'jit', // cette ligne

// On adapte le model Event

// Pour avoir les images disponibles en front :
// php artisan storage:link 


//-------------------
// API
//-------------------

php artisan make:controller Api/EventController --api
php artisan make:resource EventResource

// on les modifie

// Pour rajouter un prefixe api sur nos routes de l'api
// On modifie le fichier app/Providers/RouteServiceProvider.php

// On rajoute un fichier dans routes :  routes/api.php
Route::apiResource('events', EventController::class);
// Cela crée automatiquement les routes suivantes :
// GET	    /api/events	        index	
// GET	    /api/events/{event}	show	
// POST	    /api/events	        store	
// PUT	    /api/events/{event}	update	
// DELETE	/api/events/{event}	destroy	

// On crée les vues

// On adapte les routes
*/