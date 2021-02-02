@extends('layouts.familiaris')
@section('title') Familiaris - crear @endsection 
@section('content')
@section('fieldset') 
<i class="material-icons">create</i>
{{__('words.Progresa_familia')}} - {{__('words.Crear_proyecto')}} @endsection
	@if(count($errors) > 0)
		<div class="errors">
			<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
			</ul>
		</div>
	@endif
	<form action="/proyectos/crear" method="post">
		Nombre: <input type="text" name="nombre" value="{{old('nombre')}}">
		<br>
		Objetivo: <input type="text" name="objetivo" value="{{old('objetivo')}}">
		<br>
		Costo mano de obra: <input type="text" name="costo_mano_de_obra" value="{{old('costo_mano_de_obra')}}">
		<br>
		Costo materiales: <input type="text" name="costo_materiales" value="{{old('costo_materiales')}}">
		<br>
		Costo servicios: <input type="text" name="costo_servicios" value="{{old('costo_servicios')}}">
		<br>
		Porcentaje imprevistos: <input type="text" name="costo_imprevistos" value="{{old('costo_imprevistos')}}">
		<br>
		Tiempo estimado: <input type="text" name="tiempo_previsto" value="{{old('tiempo_previsto')}}">
		Unidad de Tiempo: <input type="text" name="unidad_id" value="{{old('unidad_tiempo')}}">
		<br>
		<input type="hidden" name="user_id" value="{{ Auth::id() }}" >
		<input type="hidden" name="fecha_inicio" value="{{ date('Y-m-d H:i:s') }}" >
		<input type="hidden" name="_token" value="{{ csrf_token() }}" >
		<input type="submit" value="Crear">
	</form>
@stop