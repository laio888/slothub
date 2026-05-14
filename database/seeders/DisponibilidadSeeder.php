<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DisponibilidadSeeder extends Seeder {
    public function run(): void {
        $horarios = [];

        // Generar horarios para los próximos 14 días
        // Lunes a Sábado, de 8am a 6pm, bloques de 1 hora
        for ($dia = 1; $dia <= 14; $dia++) {
            $fecha = Carbon::today()->addDays($dia);

            // Saltar domingos (0 = domingo)
            if ($fecha->dayOfWeek === Carbon::SUNDAY) continue;

            $bloques = [
                ['08:00', '09:00'],
                ['09:00', '10:00'],
                ['10:00', '11:00'],
                ['11:00', '12:00'],
                ['14:00', '15:00'],
                ['15:00', '16:00'],
                ['16:00', '17:00'],
                ['17:00', '18:00'],
            ];

            foreach ($bloques as [$inicio, $fin]) {
                $horarios[] = [
                    'fecha'                  => $fecha->toDateString(),
                    'hora_inicio'            => $inicio,
                    'hora_fin'               => $fin,
                    'estado_disponibilidad'  => 'disponible',
                    'created_at'             => now(),
                    'updated_at'             => now(),
                ];
            }
        }

        DB::table('disponibilidad')->insert($horarios);
    }
}
