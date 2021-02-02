@extends('layouts.app')
@section('title')Familiaris - crear @endsection 
@section('content')

	<?php foreach ($proyectos as $proyecto): ?>
		<h3><u>{{ $proyecto->nombre }}</u> </h3>	
		<a href='{{ route("envia1", ['id'=>$proyecto->id] ) }}'>
		<button type="button"  class="btn btn-primary btn-xs">
		Invitar Socio</button></a>
		<p>
		<b>Objetivo: </b>{{ $proyecto->objetivo }}<br>
		<b>Tiempo Previsto: </b>{{ $proyecto->tiempo_previsto }}
		{{ $proyecto->unidades->nombre }} <br>
		<b>Creado por: </b>{{ $proyecto->creador->name }}
		</p>
	<?php endforeach ?>
@stop