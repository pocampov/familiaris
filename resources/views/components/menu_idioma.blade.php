      <!-- Boton de idiomas -->
        <div class="dropdown">
  			<button type="button" class="btn btn-secondary dropdown-toggle btn-sm" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
    		<i class="material-icons" style="font-size: 18px;">translate</i>
  			</button>
  			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    			<a class="dropdown-item" href="{{ route('idioma',['lan'=>'es']) }} "><img src="{{asset('img/es.png')}}"> Es</a>
    			<a class="dropdown-item" href="{{ route('idioma',['lan'=>'en']) }} "><img src="{{asset('img/gb.png')}}"> En</a>
		    </div>
  		</div>
	   <!-- Fin boton -->		
