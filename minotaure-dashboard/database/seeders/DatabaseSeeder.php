<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class); // execute le seeder des roles et permissions

        User::factory()->count(10)->create([
            'password' => Hash::make('password'),
        ])->each(fn ($user) => $user->assignRole('client'));

        User::factory(3)->create([
            'password' => Hash::make('password'),
        ])->each(fn ($user) => $user->assignRole('developpeur'));

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ])->assignRole('admin');

        Project::factory()->count(10)->create();
    }
}
