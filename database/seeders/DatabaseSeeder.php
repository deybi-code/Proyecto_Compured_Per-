<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Esto creará al administrador con la contraseña encriptada correctamente
        User::create([
            'nombre_completo' => 'Administrador Compured',
            'correo'          => 'admin@compured.com',
            'password'        => Hash::make('tu_contraseña_aqui'), // Pon aquí la contraseña que quieras usar
            'rol'             => 'admin',
            'preferencia_tema'=> 'light',
            'fecha_registro'  => now(),
        ]);
    }
}
