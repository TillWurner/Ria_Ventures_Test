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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->string('telefono', 15)->nullable();
            $table->text('direccion')->nullable();
            $table->string('cargo')->nullable();
            $table->string('estado')->nullable(); //Activo-Inactivo
            $table->string('profile_photo_path', 2048)->nullable();
            $table->text('foto')->nullable();
            $table->string('tipo_usuario')->nullable(); //A-E //administrador-ejecutivo

            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
