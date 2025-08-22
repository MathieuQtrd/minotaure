<?php

//--------------------------------------------------
//--------------------------------------------------
// NOUVEAU PROJET : Site de gestion d'évènements
//--------------------------------------------------
//--------------------------------------------------

// Installer un nouveau projet avec Breeze 
// Utilisation de Spatie ou gestion des roles perso
// Mettre en place la gestion utilisateur
// Commencer à penser la partie Front office et la partie back office

// Role Admin           : tous les droits
// Role Organisateur    : possibilité de créer des événements
// Role utilisateur     : possibilité de s'inscrire à un événement

// exemple :
// Role intégrateur
// Role commercial
// Role ...

// Commencer pour l'admin une ou des pages de gestion utilisateur
// liste des utilisateur
// ajouter un utilisateur
// changement de role
// suppression d'un utilisateur
// modification d'un utilisateur



//---------------------------------------------------
//---------------------------------------------------
// Exemple d'étapes pour commencer
//---------------------------------------------------
//---------------------------------------------------
/*
Etapes pour laravel_evenements
    nouvelle installation laravel en choississant breeze
    suivre les étapes avec notamment le choix de blade
    après avoir choisi le SGBD (mysql), aller dans le fichier .env pour rajouter ces lignes (au cas où c'est nécessaire) :
DB_CHARSET=utf8
DB_COLLATION=utf8_general_ci

    une fois l'installation terminée : npm install puis npm run dev et on change de console
    ensuite php artisan serve et on change de console
    Si vous faites le choix d'utiliser Spatie :

composer require spatie/laravel-permission

php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

    aller dans le dernier fichier de migration (database/migrations/) et changer ces deux éléments (si nécessaire, toujours lié au souci de taille des string selon la version de MySQL) : Sur les deux création des tables roles et permissions

$table->string('name');
$table->string('guard_name');

On change par 

$table->string('name', 225);
$table->string('guard_name', 25);

    php artisan migrate

    Ensuite il faut aller dans le model User Pour rajouter le trait HasRole

use Spatie\Permission\Traits\HasRoles; // à rajouter

class User extends Authenticatable
{
    use HasRoles; // à rajouter
    //...
}

    Dernière étape, il faut rajouter les middlewares dans bootstrap/app.php
//...
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'role' => \Spatie\Permission\Middleware\RoleMiddleware::class, 
        'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class, 
        'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class, 
    ]);
})

//...

    Possibilité de mettre les traductions fr, un mot de passe robuste etc ...
    Ne pas hésiter à créer un seeder pour commencer à créer des roles, persmissions et des utilisateurs
    Commencer à faire les controllers, les vues, la gestion du menu etc ..


*/