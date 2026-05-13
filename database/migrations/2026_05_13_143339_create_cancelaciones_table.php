<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cancelaciones', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_cancelacion');
            $table->text('motivo')->nullable();
            $table->decimal('reembolso', 10, 2)->default(0);
            $table->foreignId('id_cita')
                ->constrained('citas')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('cancelaciones');
    }
};
