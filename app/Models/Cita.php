<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cita extends Model {

    protected $table = 'citas';

    protected $fillable = [
        'fecha_cita',
        'hora_inicio',
        'hora_fin',
        'estado_cita',
        'observaciones',
        'id_cliente',
        'id_disponibilidad',
    ];

    // Relaciones...
    // La cita pertenece a un cliente
    public function cliente(): BelongsTo {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    // La cita pertenece a un horario disponible
    public function disponibilidad(): BelongsTo {
        return $this->belongsTo(Disponibilidad::class, 'id_disponibilidad');
    }

    // Una cita puede tener muchos servicios (detalle)
    public function detalles(): HasMany {
        return $this->hasMany(DetalleCita::class, 'id_cita');
    }

    // Una cita puede tener un pago
    public function pago(): HasOne {
        return $this->hasOne(Pago::class, 'id_cita');
    }

    // Una cita puede tener una cancelación
    public function cancelacion(): HasOne {
        return $this->hasOne(Cancelacion::class, 'id_cita');
    }

    // Calcula el total
    //Suma los subtotales del detalle
    public function totalCita(): float {
        return $this->detalles->sum('subtotal');
    }

    // Calcula el anticipo del 50%
    public function anticipo(): float {
        return round($this->totalCita() * 0.5, 2);
    }
}
