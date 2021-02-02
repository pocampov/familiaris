<div class="card w-80">
  <div class="card-header">
    {{ strtoupper($nombre_proyecto) }}
  </div>
  <div class="card-body">
    <h5 class="card-title">{{ $objetivo }} </h5>
    <p class="card-text h6">
	@if ( isset($creador) )
		<b>{{ __('words.Creador') }}: </b>{{ $creador }}
	@endif<br>
	@if ( isset($costo_previsto) )
		<b>{{ __('words.Costo_previsto') }}: </b><span pattern="(d{3})([.])(d{2})">{{ $costo_previsto }}</span>
	@endif<br>
	@if ( isset($fecha_inicio) )
		<b>{{ __('words.Fecha_inicio') }}: </b>{{ $fecha_inicio }}
	@endif<br>
	@if ( isset($avance) )
		<b>{{ __('words.Avance') }}: </b>{{ $avance }}%
	@endif<br>
	</p>

	<!--  Botones de Invitar y actividades o aceptar invitacion -->  
	@if ( isset($rol) || isset($proyecto_id) || isset($creador) )
      @if ($rol != 'Invitado')
      	<a href="{{ route('envia1',['id'=>$proyecto_id]) }}">
      	<button type="button" class="badge badge-info" data-toggle="popover" title={{ __('words.Invita_socio') }} data-placement="auto" ><i class="material-icons">group_add</i><br>{{ strtoupper(__('words.Invitar')) }}</button>
      	</a>
      	<a href="{{ route('ver_actividades',['proyecto_id'=>$proyecto_id]) }}">
      	<button type="button" onclick ="location.href={{ route('ver_actividades',['proyecto_id'=>$proyecto_id]) }}" class="badge badge-info" data-toggle="popover" title={{ __('words.Agregar_actividades') }} data-placement="top"><i class="material-icons">alarm_on</i><span class="align-top"><br>{{strtoupper( __('words.Actividades')) }}</span></button>
      	</a>
      @else  
        <a href="{{ route('acepta_invitacion',['proyecto_id'=>$proyecto_id]) }}">
      	<button type="button" onclick ="location.href={{ route('ver_actividades',['proyecto_id'=>$proyecto_id]) }}" class="badge badge-info" data-toggle="popover" title={{ __('words.Acepta_invitacion') }} data-placement="top"><i class="material-icons">how_to_reg</i>{{ strtoupper(__('words.Aceptar')) }}</button>
      	</a><div>{{ $creador }} Te ha invitado</div>
	  @endif
	 @endif
  </div>
</div>