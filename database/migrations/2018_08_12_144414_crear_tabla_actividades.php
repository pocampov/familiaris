<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaActividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('actividades', function (Blueprint $table) {
			$table->increments('id');
			$table->string('nombre');
			$table->integer('tiempo'); // Duración de la actividad
			$table->integer('unidad_id')->unsigned(); //Unidad del tiempo (dias, horas, etc)
			$table->integer('costo_estimado'); //Costo estimado de la actividad
			$table->integer('costo_real'); //Costo real final de la actividad
			$table->integer('porcentaje_avance');
			$table->string('entregable');
			$table->string('fecha_inicio');
			$table->integer('proyecto_id')->unsigned();
			$table->string('email_responsable',100);
			$table->integer('id_actividad'); //Consecutivo dentro del proyecto
            $table->timestamps();
			$table->foreign('email_responsable')->references('email')->on('users');
			$table->foreign('proyecto_id')->references('id')->on('proyectos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividades');
    }
}
