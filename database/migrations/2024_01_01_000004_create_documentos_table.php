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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 10);
            $table->year('anno');
            $table->string('numero', 10);
            $table->date('fecha');
            $table->text('descripcion')->nullable();
            $table->string('archivo_path');
            $table->boolean('publicado')->default(true);
            
            // Índice único para evitar documentos duplicados
            $table->unique(['tipo', 'numero', 'anno'], 'unique_documento');
            
            // Foreign keys
            $table->foreign('tipo')->references('prefijo')->on('tipos')->onDelete('cascade');
            $table->foreign('anno')->references('anno')->on('annos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
