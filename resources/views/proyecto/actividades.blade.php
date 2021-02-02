@extends('layouts.familiaris')

@section('title') Actividades del Proyecto @endsection 
@section('fieldset') 
<i class="material-icons">alarm_on</i>
Actividades del proyecto: {{ $nombre_proyecto }} @endsection
@section('content')

<table class="table table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Duraci&oacute;n</th>
      <th scope="col">Fecha de Inicio</th>
      <th scope="col">Avance</th>
      <th scope="col">Costo Estimado</th>
      <th scope="col">Costo Real</th>
      <th scope="col">Responsable</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $actividades = $actividad;
  foreach ($actividades as $actividad): ?>
    <tr>
      <th scope="row">{{ $actividad->id }}</th>
      <td>{{ $actividad->nombre }}</td>
      <td>{{ $actividad->tiempo.' '.$actividad->unidad->nombre }}</td>
      <td>{{ $actividad->fecha_inicio }}</td>
	  <td>{{ $actividad->porcentaje_avance.'%' }}</td>
	  <td>{{ $actividad->costo_estimado }}</td>
	  <td>{{ $actividad->costo_real }}</td>
	  <td>{{ $actividad->email_responsable }}</td>
    </tr>
  <?php endforeach ?>
	<tr><a href="{{ url('inserta_actividad', ['id'=>0,'proyecto_id'=>$proyecto_id]) }}" class="badge badge-info">Agregar Actividad</a></tr>
  </tbody>
</table>
  <a href="{{ url('inserta_actividad', ['id'=>0,'proyecto_id'=>$proyecto_id]) }}" class="badge badge-info">Agregar Actividad</a>
@endsection
