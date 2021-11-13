<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicituds', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('NRC');
            $table->string('asignatura');
            $table->string('detalle');
            $table->string('calificacion');
            $table->string('numeroAyudantias');
            $table->string('numeroTelefonico');
            $table->string('nombreProfesor');
            $table->string('estadoSolicitud');
            $table->string('tipoSolicitud');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicituds');
    }
}
