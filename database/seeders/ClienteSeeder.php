<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClienteSeeder extends Seeder {
    public function run(): void {
        $clientes = [
            // Admin
            [
                'nombres'        => 'Leanny',
                'apellidos'      => 'Alzate',
                'telefono'       => '3001234567',
                'correo'         => 'admin@cosmetologia.com',
                'contrasena'     => Hash::make('admin12345'),
                'rol'            => 'admin',
                'fecha_registro' => now()->toDateString(),
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // Clientes de prueba
            [
                'nombres'        => 'María',
                'apellidos'      => 'García',
                'telefono'       => '3109876543',
                'correo'         => 'maria@gmail.com',
                'contrasena'     => Hash::make('12345678'),
                'rol'            => 'cliente',
                'fecha_registro' => now()->toDateString(),
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nombres'        => 'Valentina',
                'apellidos'      => 'López',
                'telefono'       => '3155551234',
                'correo'         => 'valentina@gmail.com',
                'contrasena'     => Hash::make('12345678'),
                'rol'            => 'cliente',
                'fecha_registro' => now()->toDateString(),
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ];

        DB::table('clientes')->insert($clientes);
    }
}
