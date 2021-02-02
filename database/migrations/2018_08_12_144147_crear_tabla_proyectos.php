<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaProyectos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
			$table->string('nombre');
			$table->string('objetivo');
			$table->integer('user_id')->unsigned(); //Usuario Creador
			$table->integer('costo_mano_de_obra');
			$table->integer('costo_materiales');
			$table->integer('costo_servicios');
			$table->integer('costo_imprevistos');
			$table->integer('tiempo_previsto');
			$table->date('fecha_inicio');
			$table->integer('unidad_id')->unsigned();			
			$table->increments('id');
            $table->timestamps();
			$table->foreign('user_id')->references('id')->on('users');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyectos');
    }
}
