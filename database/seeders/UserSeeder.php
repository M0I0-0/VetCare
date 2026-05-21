<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@vetcare.com'],
            [
                'name' => 'Administrador VetCare',
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Veterinario
        \App\Models\User::updateOrCreate(
            ['email' => 'vet@vetcare.com'],
            [
                'name' => 'Dr. Carlos Veterinario',
                'password' => \Illuminate\Support\Facades\Hash::make('vet123'),
                'role' => 'veterinario',
            ]
        );

        // Recepcionista
        \App\Models\User::updateOrCreate(
            ['email' => 'recep@vetcare.com'],
            [
                'name' => 'Ana Recepcionista',
                'password' => \Illuminate\Support\Facades\Hash::make('recep123'),
                'role' => 'recepcionista',
            ]
        );
    }
}
