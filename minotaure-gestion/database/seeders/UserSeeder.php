<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // model user
use Illuminate\Support\Facades\Hash; // pour hasher les mdp


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'      =>  'admin',
            'email'     =>  'admin@mail.fr',
            'password'  =>  Hash::make('Password@123'),
            'role'      =>  'admin',
        ]);

        User::create([
            'name'      =>  'dev',
            'email'     =>  'dev@mail.fr',
            'password'  =>  Hash::make('Password@123'),
            'role'      =>  'developpeur',
        ]);

        User::create([
            'name'      =>  'client',
            'email'     =>  'client@mail.fr',
            'password'  =>  Hash::make('Password@123'),
            'role'      =>  'client',
        ]);
    }
}
