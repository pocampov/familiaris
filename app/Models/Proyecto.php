<?php

namespace Familiaris;

use Illuminate\Database\Eloquent\Model;


class Proyecto extends Model
{
    protected $fillable = ['nombre','user_id','fecha_inicio','objetivo','costo_mano_de_obra','costo_materiales','costo_servicios','costo_imprevistos','tiempo_previsto','unidad_id'];

    public function unidades()
    {
        return $this->hasOne(Unidad::class,'id','unidad_id');
    }	
	public function creador()
	{
		return $this->hasOne(User::class,'id','user_id');
	}
	public function rol_usuario($email_usuario)
	{
	   $rol = UsuarioRollProyecto::where('proyecto_id','=',$this->id)->where('email_invitado','=',$email_usuario)->get();
	   if ($rol->isEmpty()) 
	       $respuesta = $this->id;
	   else
	       $respuesta = $rol->first()->tipo_rol;
	    return $respuesta;
	}
	public function avance()
	{
	    //Calcular el avance tomando el avance de cada actividad
		$actividad = new Actividad();
		$avance = $actividad->promediar_avance($this->id);

	    return $avance;
	}
}
