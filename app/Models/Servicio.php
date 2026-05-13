<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Servicio extends Model {

    protected $table = 'servicios';

    protected $fillable = [
        'nombre_servicio',
        'categoria',
        'descripcion',
        'precio',
        'duracion_estimada',
        'estado_servicio',
    ];

    // ── Relaciones ──────────────────────────────
    // Un servicio aparece en muchos detalles de cita
    public function detalles(): HasMany {
        return $this->hasMany(DetalleCita::class, 'id_servicio');
    }
}
