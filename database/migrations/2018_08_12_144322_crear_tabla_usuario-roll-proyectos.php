<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuarioRollProyectos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario-roll-proyectos', function (Blueprint $table) {
            $table->string('email_usuario',100);
            $table->string('email_invitado',100);
			$table->string('tipo_rol',100);
			$table->integer('proyecto_id')->unsigned();
			$table->integer('rol_id')->unsigned();
			$table->increments('id');
            $table->timestamps();
			$table->foreign('proyecto_id')->references('id')->on('proyectos');
			$table->foreign('email_usuario')->references('email')->on('users');
			$table->foreign('rol_id')->references('id')->on('rolles');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario-roll-proyectos');
    }
}
