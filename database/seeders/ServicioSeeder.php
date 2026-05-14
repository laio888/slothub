<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicioSeeder extends Seeder {
    public function run(): void {
        $servicios = [
            // Corporales
            [
                'nombre_servicio'   => 'Reducción',
                'categoria'         => 'Corporales',
                'descripcion'       => 'Tratamiento corporal para reducción de medidas.',
                'precio'            => 700000,
                'duracion_estimada' => 60,
                'estado_servicio'   => 'activo',
            ],
            [
                'nombre_servicio'   => 'Post operatorios',
                'categoria'         => 'Corporales',
                'descripcion'       => 'Masajes y tratamientos post operatorios.',
                'precio'            => 550000,
                'duracion_estimada' => 60,
                'estado_servicio'   => 'activo',
            ],
            [
                'nombre_servicio'   => 'Tonificación',
                'categoria'         => 'Corporales',
                'descripcion'       => 'Tratamiento para tonificar el cuerpo.',
                'precio'            => 800000,
                'duracion_estimada' => 60,
                'estado_servicio'   => 'activo',
            ],
            [
                'nombre_servicio'   => 'Volumen de Glúteos',
                'categoria'         => 'Corporales',
                'descripcion'       => 'Tratamiento para aumentar y definir glúteos.',
                'precio'            => 1200000,
                'duracion_estimada' => 90,
                'estado_servicio'   => 'activo',
            ],
            [
                'nombre_servicio'   => 'Cauterización de lunares',
                'categoria'         => 'Corporales',
                'descripcion'       => 'Eliminación de lunares mediante cauterización.',
                'precio'            => 50000,
                'duracion_estimada' => 20,
                'estado_servicio'   => 'activo',
            ],
            [
                'nombre_servicio'   => 'Masajes de relajación',
                'categoria'         => 'Corporales',
                'descripcion'       => 'Masajes relajantes para aliviar tensiones.',
                'precio'            => 110000,
                'duracion_estimada' => 45,
                'estado_servicio'   => 'activo',
            ],

            // Faciales
            [
                'nombre_servicio'   => 'Limpieza facial',
                'categoria'         => 'Faciales',
                'descripcion'       => 'Limpieza profunda del rostro.',
                'precio'            => 100000,
                'duracion_estimada' => 45,
                'estado_servicio'   => 'activo',
            ],
            [
                'nombre_servicio'   => 'Plasma capilar',
                'categoria'         => 'Faciales',
                'descripcion'       => 'Tratamiento capilar con plasma rico en plaquetas.',
                'precio'            => 130000,
                'duracion_estimada' => 50,
                'estado_servicio'   => 'activo',
            ],
            [
                'nombre_servicio'   => 'Plasma 4ª generación',
                'categoria'         => 'Faciales',
                'descripcion'       => 'Tratamiento facial con plasma de cuarta generación.',
                'precio'            => 170000,
                'duracion_estimada' => 60,
                'estado_servicio'   => 'activo',
            ],
            [
                'nombre_servicio'   => 'Hidratación de labios',
                'categoria'         => 'Faciales',
                'descripcion'       => 'Hidratación profunda y volumen natural de labios.',
                'precio'            => 140000,
                'duracion_estimada' => 30,
                'estado_servicio'   => 'activo',
            ],
            [
                'nombre_servicio'   => 'Relleno de surcos',
                'categoria'         => 'Faciales',
                'descripcion'       => 'Relleno de surcos nasogenianos.',
                'precio'            => 200000,
                'duracion_estimada' => 40,
                'estado_servicio'   => 'activo',
            ],
            [
                'nombre_servicio'   => 'Botox natural lifting facial',
                'categoria'         => 'Faciales',
                'descripcion'       => 'Lifting facial con técnica botox natural.',
                'precio'            => 330000,
                'duracion_estimada' => 60,
                'estado_servicio'   => 'activo',
            ],

            // Depilación
            [
                'nombre_servicio'   => 'Cejas',
                'categoria'         => 'Depilación',
                'descripcion'       => 'Depilación y perfilado de cejas con cera.',
                'precio'            => 22000,
                'duracion_estimada' => 15,
                'estado_servicio'   => 'activo',
            ],
            [
                'nombre_servicio'   => 'Cejas con henna',
                'categoria'         => 'Depilación',
                'descripcion'       => 'Depilación de cejas con diseño en henna.',
                'precio'            => 28000,
                'duracion_estimada' => 20,
                'estado_servicio'   => 'activo',
            ],
            [
                'nombre_servicio'   => 'Bigote',
                'categoria'         => 'Depilación',
                'descripcion'       => 'Depilación de bigote con cera.',
                'precio'            => 7000,
                'duracion_estimada' => 10,
                'estado_servicio'   => 'activo',
            ],
            [
                'nombre_servicio'   => 'Axilas',
                'categoria'         => 'Depilación',
                'descripcion'       => 'Depilación de axilas con cera.',
                'precio'            => 18000,
                'duracion_estimada' => 15,
                'estado_servicio'   => 'activo',
            ],
            [
                'nombre_servicio'   => 'Bikini',
                'categoria'         => 'Depilación',
                'descripcion'       => 'Depilación de zona bikini con cera.',
                'precio'            => 55000,
                'duracion_estimada' => 30,
                'estado_servicio'   => 'activo',
            ],
            [
                'nombre_servicio'   => 'Media pierna',
                'categoria'         => 'Depilación',
                'descripcion'       => 'Depilación de media pierna con cera.',
                'precio'            => 36000,
                'duracion_estimada' => 25,
                'estado_servicio'   => 'activo',
            ],
            [
                'nombre_servicio'   => 'Pierna completa',
                'categoria'         => 'Depilación',
                'descripcion'       => 'Depilación de pierna completa con cera.',
                'precio'            => 75000,
                'duracion_estimada' => 45,
                'estado_servicio'   => 'activo',
            ],

            // Sueroterapia
            [
                'nombre_servicio'   => 'Detox',
                'categoria'         => 'Sueroterapia',
                'descripcion'       => 'Suero desintoxicante para el organismo.',
                'precio'            => 100000,
                'duracion_estimada' => 45,
                'estado_servicio'   => 'activo',
            ],
            [
                'nombre_servicio'   => 'Nutrición',
                'categoria'         => 'Sueroterapia',
                'descripcion'       => 'Suero de nutrición y vitaminas.',
                'precio'            => 150000,
                'duracion_estimada' => 45,
                'estado_servicio'   => 'activo',
            ],
            [
                'nombre_servicio'   => 'Obesidad',
                'categoria'         => 'Sueroterapia',
                'descripcion'       => 'Suero para tratamiento de obesidad.',
                'precio'            => 110000,
                'duracion_estimada' => 45,
                'estado_servicio'   => 'activo',
            ],
            [
                'nombre_servicio'   => 'Metabolismo',
                'categoria'         => 'Sueroterapia',
                'descripcion'       => 'Suero activador del metabolismo.',
                'precio'            => 100000,
                'duracion_estimada' => 45,
                'estado_servicio'   => 'activo',
            ],
            [
                'nombre_servicio'   => 'Colágeno',
                'categoria'         => 'Sueroterapia',
                'descripcion'       => 'Suero de colágeno para la piel.',
                'precio'            => 120000,
                'duracion_estimada' => 45,
                'estado_servicio'   => 'activo',
            ],
        ];

        foreach ($servicios as $s) {
            DB::table('servicios')->insert([
                ...$s,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
