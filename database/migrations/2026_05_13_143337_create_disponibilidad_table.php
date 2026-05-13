<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('disponibilidad', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->enum('estado_disponibilidad', ['disponible', 'ocupado', 'bloqueado'])
                ->default('disponible');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('disponibilidad');
    }
};
