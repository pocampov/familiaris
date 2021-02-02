@extends('layouts.familiaris')
@section('title') Familiaris @endsection 

@section('fieldset') {{ $actividad->proyecto->nombre }} - 
@if (isset($actividad->nombre)) 
		 {{ __('words.Editar_actividad') }}
@else
		 {{ __('words.Crear_actividad') }}
@endif
@endsection
@section('content')
	@if(count($errors) > 0)
		<div class="errors">
			<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
			</ul>
		</div>
	@endif

  <form action="/proyectos/actividades"  method="post">
  @component('components.actividad_card')
	@slot('nombre_proyecto'){{ $actividad->proyecto->nombre }}@endslot
  	@slot('label_nombre') {{ __('words.Nombre') }} @endslot
  	@slot('duracion') {{$actividad->tiempo}} @endslot
  	@slot('unidad_id') {{ $actividad->unidad_id }} @endslot
	@slot('unidades', $unidades->toArray() )
	@slot('nombre') {{ $actividad->nombre }} @endslot
	@slot('fecha_inicio') {{ $actividad->fecha_inicio }} @endslot
	@slot('costo_estimado') {{ $actividad->costo_estimado }} @endslot
	@slot('costo_real') {{ $actividad->costo_real }} @endslot
	@slot('porcentaje_avance') {{ $actividad->porcentaje_avance }} @endslot
	@slot('entregable') {{ $actividad->entregable }} @endslot
	@slot('email_responsable') {{ $actividad->email_responsable }} @endslot
	@slot('proyecto_id') {{ $actividad->proyecto_id }} @endslot
	@slot('actividad_id') {{ $actividad->id }} @endslot
	@slot('id_actividad') {{ $actividad->id_actividad }} @endslot
  @endcomponent
  </form>

@endsection

<!-- Hasta aqui la nueva tarjeta -->
