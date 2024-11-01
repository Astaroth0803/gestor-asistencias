<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciasTable extends Migration
{
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('edad');
            $table->string('sexo');
            $table->string('sector');
            $table->foreignId('actividad_id')->constrained('actividades');
            $table->date('fecha_asistencia');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asistencias');
    }
}
