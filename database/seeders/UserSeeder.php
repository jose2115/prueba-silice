<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::create([
            'name'      => 'Administrador',
            'full_name' => 'Jose David Gonzalez',
            'email'     => 'jose@gmail.com',
            'nif'       => '000000000000',
            'password'  => Hash::make('123456789'),
        ]);

        $user->assignRole('Administrador');
    }
}
