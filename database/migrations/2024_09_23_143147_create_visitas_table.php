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
        Schema::create('visitas', function (Blueprint $table) {

            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->string('cliente_nombre'); 
            $table->string('cliente_telefono'); 
            $table->string('cliente_email');
            $table->string('forma_contacto');
            $table->string('estado_visita')->nullable(); 
            $table->string('referencia')->nullable(); 
            $table->string('link')->nullable(); 
            $table->double('latitud'); 
            $table->double('longitud'); 
            $table->dateTime('fecha_visita'); 
            $table->timestamps(); 


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitas');
    }
};
