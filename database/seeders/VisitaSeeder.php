<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class VisitaSeeder extends Seeder
{
    public function run()
    {
        DB::table('visitas')->insert([
            'user_id' => 2, 
            'cliente_nombre' => 'Bernardo',
            'cliente_telefono' => '123456789',
            'cliente_email' => 'bernardo@example.com',
            'forma_contacto' => 'Telefono',
            'estado_visita' => 'Programada',
            'fecha_visita' => now(),
            'referencia' => 'Feria',
            'link' => 'https://maps.app.goo.gl/EJAupmKq5eLHmawd7',
            'latitud' => -17.78466952303708,
            'longitud' => -63.208873271942146,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
