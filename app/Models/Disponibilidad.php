<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Disponibilidad extends Model {

    protected $table = 'disponibilidad';

    protected $fillable = [
        'fecha',
        'hora_inicio',
        'hora_fin',
        'estado_disponibilidad',
    ];

    // ── Relaciones ──────────────────────────────
    // Un horario disponible puede tener una sola cita
    public function cita(): HasOne {
        return $this->hasOne(Cita::class, 'id_disponibilidad');
    }
}
