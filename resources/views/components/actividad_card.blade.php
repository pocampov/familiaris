  <div class="card w-100">
    <div class="card-header">
	@if ( isset($nombre_proyecto) )
	    {{ strtoupper($nombre_proyecto) }}
	@endif
  	</div>
    <div class="card-body">
      
      <table class="table table-striped">
		  <tbody>
    		<tr>
      			<th scope="row"><label for="nombre">{{ __('words.Actividad') }}:</label></th>
				<td><input type="text" name="nombre" class="form-control" value="{{old('nombre',$nombre)}}" placeholder="{{ __('words.Describa_actividad') }}"></td>
      	    </tr>
    		<tr>
      			<th scope="row"><label for="tiempo">{{ __('words.Duracion') }}:</label></th>
      			<td class='row'>
      			
      				&nbsp;&nbsp;&nbsp;&nbsp;<input type="number" class="form-control w-25" name="tiempo" value="{{old('tiempo',$duracion)}}" placeholder="{{ __('words.Duracion_actividad') }}">
      				<select class="form-control w-50" name="unidad_id" value="{{ old('unidad_id',$unidad_id) }}">
    				@foreach ($unidades as $unidad)
						<option value="{{ $unidad['id'] }}"
						@if ($unidad_id == strval($unidad['id']))
							selected
						@endif
						>{{ $unidad[key($unidad)] }}
						</option>
					@endforeach
					</select>
      			</td>
		    </tr>
			<tr>
      			<th scope="row"><label for="fecha_inicio">{{__('words.Fecha_inicio')}}:</label></th>
      			<td><input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio',$fecha_inicio) }}"></td>
		    </tr>
		    <tr>
      			<th scope="row"><label for="costo_estimado">{{ __('words.Costo_previsto') }}: </label></th>
      			<td><input type="number" min="0" class="form-control" placeholder="$" name="costo_estimado" value="{{old('costo_estimado',$costo_estimado)}}"></td>
		    </tr>
  			<tr>
      			<th scope="row"><label for="costo_real">{{ __('words.Costo_real')}}: </label></th>
      			<td><input type="number"  min="0" placeholder="$" name="costo_real" class="form-control" value="{{old('costo_real',$costo_real)}}"></label></td>
		    </tr>
  			<tr>
      			<th scope="row"><label for="avance">{{ __('words.Avance') }}: </label></th>
      			<td><script>
					function porce() {
						document.getElementById("num").innerHTML = document.getElementById("porcentaje").value;
						}
				</script>
				<b id="num">{{ $porcentaje_avance}}</b>%<input type="range" max="100" min="0" id="porcentaje" class="form-control-range" name="porcentaje_avance" value="{{old('porcentaje_avance',$porcentaje_avance)}}" onchange="porce()" list="tickmarks">
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
				</datalist></td>
		    </tr>
  			<tr>
      			<th scope="row"><label for="entregable">{{ __('words.Entregable') }}:</label></th>
      			<td><input type="text" name="entregable" class="form-control" value="{{old('entregable',$entregable)}}" placeholder="{{ __('words.Resultado_actividad') }}"></td>
		    </tr>
  			<tr>
      			<th scope="row"><label for="responsable">{{ __('words.Responsable') }}:</label></th>
      			<td><input type="text" name="email_responsable" class="form-control" value="{{ old('email_responsable',$email_responsable) }}"></td>
		    </tr>
		    <tr>
		    	<th scope="row"></th>
					<input type="hidden" name="proyecto_id" value="{{ old('proyecto_id',$proyecto_id) }}" >
					<input type="hidden" name="id" value="{{ old('id',$actividad_id) }}" >
					<input type="hidden" name="id_actividad" value="{{ old('id_actividad',$id_actividad) }}" >
					<input type="hidden" name="_token" value="{{ csrf_token() }}" >
					<td><input type="submit" value="{{ __('words.Grabar') }} " class="btn btn-primary"></td>
		    </tr>
  		</tbody>
	</table>  
    
   </div>
</div>   
