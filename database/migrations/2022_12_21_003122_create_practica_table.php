<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practicas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuarioId')->nullable(false);
            $table->string('campo_clinico');
            $table->string('nivel_cursado');
            $table->string('tipo_practica');
            $table->string('nombre_docente')->nullable();
            $table->string('telefono_docente')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_termino');
            $table->time('hora_inicio');
            $table->time('hora_termino');
            $table->time('hora_registro_inicio')->nullable(true);
            $table->time('hora_registro_termino')->nullable(true);
            $table->foreign('usuarioId')->on('users')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('practica');
    }
};
