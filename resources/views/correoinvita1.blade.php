@extends('layouts.mail')
<div class="contenedor">
<div class="cuerpo">
<center><img class="card-img-top w-75 p-3" src="http://familiaris.pasioncreadora.info/img/familia.jpg" alt="Proyecto familiar"></center>
<div class="jumbotron">
  <h1 class="display-4 w-75 p-3">Trabajemos Juntos</h1>
  <p class="lead">
	{{ $datos->input('nombre') }}<br>
	{{ $datos->input('mensaje') }}
	<br><br>{{ Auth::user()->name }}
  </p>
  <hr class="my-4">
  <center><p class="card-header text-white bg-info mb-3">
	<b>{{ strtoupper($datos->input('proyecto_nombre')) }}</b></p></center>
    <p ><b>OBJETIVO: </b>
	{{ $datos->input('objetivo') }}</p>
    <p><b>DURACI&Oacute;N: </b>
	{{ $datos->input('tiempo_previsto')." ".$datos->input('unidad') }}</p>

  <p>Acompaña a {{  Auth::user()->name }} en su proyecto registr&aacute;dote en FAMILIARIS</p>
	<a href="http://familiaris.pasioncreadora.info/recibe_invitacion?proyecto_id={{ $datos->input('proyecto_id') }}" class="badge badge-pill badge-info text-white w-50 p-3">
		CUENTA CONMIGO
	</a>
 </div>

</div>
</div>