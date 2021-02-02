@extends('layouts.familiaris')

@section('title') Lista Proyectos @endsection 
@section('fieldset') 
<i class="material-icons">business_center</i>
Progresa la familia - Tu lista de proyectos @endsection

  @section('content')
   @if (isset($proyectos)) 
  	@foreach ($proyectos as $proyecto)
  		@component('components.proyecto_card')
			@slot('objetivo') {{ $proyecto->objetivo }} @endslot
			@slot('creador') {{ $proyecto->creador->name }} @endslot
			@slot('nombre_proyecto') {{ $proyecto->nombre }} @endslot
			@slot('fecha_inicio') {{ $proyecto->fecha_inicio }} @endslot
			@slot('costo_previsto') {{ ($proyecto->costo_mano_de_obra +$proyecto->costo_materiales +$proyecto->costo_servicios)* (1+$proyecto->costo_imprevistos/100) }} @endslot
			@slot('rol') {{ $proyecto->rol_usuario($email_usuario) }} @endslot
			@slot('proyecto_id') {{ $proyecto->id }} @endslot
			@slot('avance') {{ $proyecto->avance() }} @endslot
		@endcomponent
  	@endforeach 
   @else
  	<div class="alert alert-primary" role="alert">
  		{{ __('words.Sin_proyectos')}}
	</div>
   @endif	

@endsection

