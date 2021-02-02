@extends('layouts.familiaris')
@section('title') Familiaris - Crear Actividad @endsection 
@section('fieldset') {{ $nombre_proyecto }} @endsection
@section('content')
	<h1>Crear actividad</h1>
	@if(count($errors) > 0)
		<div class="errors">
			<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
			</ul>
		</div>
	@endif
	<form action="/proyectos/actividades" method="post">
		<div class="form-row">
			<label for="nombre">Actividad:</label>
			<input type="text" name="nombre" class="form-control" value="{{old('nombre')}}" placeholder="Describa con un verbo la actividad">
		</div><br>
		<div class="form-row">
    		<div class="col-md-4 mb-4">
      			<label for="tiempo">Duraci&oacute;n:</label>
		 		<input type="number" class="form-control" name="tiempo" value="{{old('tiempo')}}" placeholder="Duraci&oacute;n de la actividad">
			</div>
    		<div class="col-md-4 mb-4">
   				<label for="unidad">Unidad de Tiempo:</label>
   				<select class="form-control" name="unidad_id" value="{{old('unidad_id')}}">
    			@foreach ($unidades as $unidad)
					<option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
				@endforeach
				</select>
			</div>
			<div class="col-md-4 mb-4">
				<label for="fecha_inicio">Fecha de inicio:</label>
				<input type="date" name="fecha_inicio" class="form-control" value="{{old('fecha_inicio')}}">
			</div>
		</div>
		<div class="form-row">
			<div class="col-md-4 mb-3">
				<label for="costo_estimado">Costo estimado: </label>
				$<input type="number" min="0" class="form-control" pattern="^\d{1,3}(?:,\d{3})*\.\d{2}$" name="costo_estimado" value="{{old('costo_estimado')}}">
			</div>
			<div class="col-md-4 mb-3">
				<label for="costo-_real">Costo real: </label>
				$<input type="number"  min="0" name="costo_real" class="form-control" value="{{old('costo_real')}}"></label>
			</div>
			<div class="col-md-4 mb-3">
				<label for="avance">Avance del proyecto: <b id="num">{{old('porcentaje_avance')}}</b>%</label>
				<script>
					function porce() {
						document.getElementById("num").innerHTML = document.getElementById("porcentaje").value;
						}
				</script>
				<input type="range" max="100" min="0" id="porcentaje" class="form-control-range" name="porcentaje_avance" value="{{old('porcentaje_avance')}}" onchange="porce()" list="tickmarks">
				<datalist id="tickmarks">
  					<option value="0" label="0%">
					<option value="10">
  					<option value="20">
  					<option value="30">
  					<option value="40">
  					<option value="50" label="50%">
  					<option value="60">
  					<option value="70">
  					<option value="80">
  					<option value="90">
  					<option value="100" label="100%">
				</datalist>
			</div>
		</div>
		<div class="form-row">
			<div class="col-md-4 mb-3">
				<label for="entregable">Entregable:</label>
				<input type="text" name="entregable" class="form-control" value="{{old('entregable')}}">
			</div>
			<div class="col-md-4 mb-3">
				<label for="responsable">Responsable:</label>
				<input type="text" name="email_responsable" class="form-control" value="{{old('email_responsable')}}">
			</div>
		</div>
		<input type="hidden" name="proyecto_id" value="{{ $proyecto_id }}" >
		<input type="hidden" name="id_actividad" value="{{ $actividades->contar_actividades($proyecto_id)+1 }}" >
		<input type="hidden" name="_token" value="{{ csrf_token() }}" >
		<center><input type="submit" value="Crear Actividad"></center>
	</form>
@stop