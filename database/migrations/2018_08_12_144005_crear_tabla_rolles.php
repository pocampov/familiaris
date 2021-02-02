<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRolles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    /* Deben insertarse asi:
     * 0 Creador 1 Socio 2 Administrador 3 Invitado */
    {
        Schema::create('rolles', function (Blueprint $table) {
            $table->string('tipo',100)->unique();
			$table->increments('id');
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
        Schema::dropIfExists('rolles');
    }
}
