<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'gabrielle-luiza16@hotmail.com'],
            [
                'name' => 'Usuário Inicial',
                'password' => Hash::make('vWHzL807AO1&UPftZ4'),
                'role' => User::ROLE_ADMIN,
            ]
        );
    }
}
