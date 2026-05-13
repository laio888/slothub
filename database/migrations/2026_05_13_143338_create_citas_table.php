<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_cita');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->enum('estado_cita', ['pendiente', 'confirmada', 'cancelada', 'completada'])
                ->default('pendiente');
            $table->text('observaciones')->nullable();
            $table->foreignId('id_cliente')
                ->constrained('clientes')
                ->onDelete('cascade');
            $table->foreignId('id_disponibilidad')
                ->constrained('disponibilidad')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('citas');
    }
};
