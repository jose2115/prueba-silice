<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::create(['name' => 'Usuario']);
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Funcionario']);
        Role::create(['name' => 'Gerente']);
        Role::create(['name' => 'Director']);
    }
}
