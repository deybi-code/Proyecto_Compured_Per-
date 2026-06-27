<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear el administrador inicial cumpliendo con el nuevo modelo 'usuarios'
        User::create([
            'nombre_completo' => 'Administrador Compured',
            'correo' => 'admin@compuredperu.com',
            'password' => Hash::make('password123'), // Cámbiala por una segura
            'rol' => 'admin',
            'preferencia_tema' => 'light',
            'fecha_registro' => now(),
        ]);
    }
}
