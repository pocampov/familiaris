@extends('layouts.mail')
<div class="contenedor">
<div class="cuerpo">
    
<div class="card" >
<div class="d-flex flex-column bd-highlight mb-3"> 
<div class="p-2 bd-highlight">
  <p><img class="card-img-top" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTxKqaQXTAnqsyZlmQ7AzYLgO8iJMBjc71HYhS-FhmqqySZ1_kO5g" alt="Proyecto familiar"></p>
   <div class="card-body">
</div>   
 <div class="p-2 bd-highlight">
    <h2 class="card-title">Trabajemos Juntos</h2>
</div>
    <p class="card-header text-white bg-info mb-3">{{ $datos->input('nombre') }}<br>
          {{ $datos->input('mensaje') }}
		 <br><br>{{ Auth::user()->name }}</p>
  </div>


    
   <div class="p-2 bd-highlight">
    <p class="card-header text-white bg-info mb-3">	
     <b>{{ strtoupper($datos->input('proyecto_nombre')) }}</b>
    </p>
   </div>
    <div class="p-2 bd-highlight">
    <h4 class="card-title">OBJETIVO</h4>
	<p class="card-text">{{ $datos->input('objetivo') }}</p>
    </div>
    <div class="p-2 bd-highlight">
     <h4 class="card-title">DURACI&Oacute;N</h4>
	 <p class="card-text">{{ $datos->input('tiempo_previsto')." ".$datos->input('unidad') }}</p>
    </div>
  <div class="card">
  <div class="card-body">
  Acompaña a {{  Auth::user()->name }} en su proyecto registr&aacute;dote en FAMILIARIS
	<a href="http://familiaris.pasioncreadora.info/recibe_invitacion?proyecto_id={{ $datos->input('proyecto_id') }}" class="badge badge-info text-white">
		CUENTA CONMIGO
	</a>
  </div>
  </div>   
 </div>
</div>
