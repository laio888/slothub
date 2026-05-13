<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Authenticatable {

    protected $table = 'clientes';

    protected $fillable = [
        'nombres',
        'apellidos',
        'telefono',
        'correo',
        'contrasena',
        'rol',
        'fecha_registro',
    ];

    protected $hidden = ['contrasena'];

    // Le decimos a Laravel que nuestra contraseña
    // no se llama 'password' sino 'contrasena'
    public function getAuthPassword(): string {
        return $this->contrasena;
    }

    // ── Relaciones ──────────────────────────────
    // Un cliente puede tener muchas citas
    public function citas(): HasMany {
        return $this->hasMany(Cita::class, 'id_cliente');
    }
}
