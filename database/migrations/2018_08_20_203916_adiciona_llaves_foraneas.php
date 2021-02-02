<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionaLlavesForaneas extends Migration
{
    /**
     * Agrega llaves foraneas de unidad de tiempo a las tablas actividades y proyectos.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('proyectos', function(Blueprint $table) {
		$table->foreign('unidad_id')->references('id')->on('unidades');
		});
		Schema::table('actividades', function(Blueprint $table) {
		$table->foreign('unidad_id')->references('id')->on('unidades');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('proyectos', function (Blueprint $table) {
			$table->dropForeign('proyectos_unidad_id_foreign'); 
		});
		Schema::table('actividades', function (Blueprint $table) {
			$table->dropForeign('actividades_unidad_id_foreign');
		});
	}
}
