<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  création des rôles :
        $admin = Role::create(['name' => 'admin']);
        $developpeur = Role::create(['name' => 'developpeur']);
        $client = Role::create(['name' => 'client']);

        // Création des permissions
        Permission::create(['name' => 'creer_projet']);
        Permission::create(['name' => 'creer_role']);
        Permission::create(['name' => 'creer_permission']);
        Permission::create(['name' => 'gerer_tache']);
        Permission::create(['name' => 'valider_tache']);
        Permission::create(['name' => 'gerer_utilisateur']);
        Permission::create(['name' => 'gerer_role']);
        Permission::create(['name' => 'gerer_permission']);

        // Attribution de permissions aux rôles
        $admin->givePermissionTo(['creer_projet', 'creer_role', 'creer_permission', 'gerer_tache', 'valider_tache', 'gerer_utilisateur', 'gerer_role', 'gerer_permission', ]);
        $developpeur->givePermissionTo(['creer_projet', 'gerer_tache',]);
        $client->givePermissionTo(['valider_tache',]);
    }
}
