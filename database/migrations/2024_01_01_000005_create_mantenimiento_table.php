<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mantenimiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('documento_id')->constrained('documentos')->onDelete('cascade');
            $table->string('accion', 50);
            $table->date('fecha');
            $table->text('descripcion')->nullable();
            $table->string('link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimiento');
    }
};
