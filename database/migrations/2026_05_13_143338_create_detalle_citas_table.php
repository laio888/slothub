<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('detalle_citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cita')
                ->constrained('citas')
                ->onDelete('cascade');
            $table->foreignId('id_servicio')
                ->constrained('servicios')
                ->onDelete('cascade');
            $table->integer('cantidad')->default(1);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('detalle_citas');
    }
};
