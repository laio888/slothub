<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleCita extends Model {

    protected $table = 'detalle_citas';

    protected $fillable = [
        'id_cita',
        'id_servicio',
        'cantidad',
        'subtotal',
    ];

    // Relaciones...
    // El detalle pertenece a una cita
    public function cita(): BelongsTo {
        return $this->belongsTo(Cita::class, 'id_cita');
    }

    // El detalle pertenece a un servicio
    public function servicio(): BelongsTo {
        return $this->belongsTo(Servicio::class, 'id_servicio');
    }
}
