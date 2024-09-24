<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nombre' => 'Admin',
                'apellido' => 'Admin',
                'email' => 'admin@gmail.com',
                'telefono' => '71239710',
                'cargo' => 'admin',
                'estado' => 'activo',
                'foto' => null,
                'password' => Hash::make('123'),
                'tipo_usuario' => 'administrador',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Ben',
                'apellido' => 'Tennison',
                'email' => 'ben@gmail.com',
                'telefono' => '71879710',
                'cargo' => 'ejecutivo',
                'estado' => 'activo',
                'foto' => '/storage/imagenes/clientes/GM2PXfjsjuOo12HPfNMTqHWNCalIlPc9m9TTY0Hz.jpg',
                'password' => Hash::make('123'),
                'tipo_usuario' => 'ejecutivo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
