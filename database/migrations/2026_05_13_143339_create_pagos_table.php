<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_pago');
            $table->decimal('monto', 10, 2);
            $table->enum('metodo_pago', ['tarjeta', 'efectivo', 'transferencia'])
                ->default('tarjeta');
            $table->enum('estado_pago', ['pendiente', 'completado', 'fallido'])
                ->default('pendiente');
            $table->string('referencia_pago')->nullable();
            $table->foreignId('id_cita')
                ->constrained('citas')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pagos');
    }
};
