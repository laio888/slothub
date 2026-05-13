<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cancelacion extends Model {

    protected $table = 'cancelaciones';

    protected $fillable = [
        'fecha_cancelacion',
        'motivo',
        'reembolso',
        'id_cita',
    ];

    // ── Relaciones ──────────────────────────────

    // La cancelación pertenece a una cita
    public function cita(): BelongsTo {
        return $this->belongsTo(Cita::class, 'id_cita');
    }
}
