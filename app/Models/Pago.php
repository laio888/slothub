<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pago extends Model {

    protected $table = 'pagos';

    protected $fillable = [
        'fecha_pago',
        'monto',
        'metodo_pago',
        'estado_pago',
        'referencia_pago',
        'id_cita',
    ];

    // ── Relaciones ──────────────────────────────

    // El pago pertenece a una cita
    public function cita(): BelongsTo {
        return $this->belongsTo(Cita::class, 'id_cita');
    }
}
