<?php

namespace Familiaris;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','provider','provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function proyectos()
    // Devuelve la coleccion de proyectos donde el usuario es creador, socio o invitado
    {
        $invitados = UsuarioRollProyecto::where('email_invitado','=',$this->email)->get(); 
        $creador = UsuarioRollProyecto::where('email_usuario','=',$this->email)->get();
        $invitados = $invitados->concat($creador);
        $i=0;
        foreach ($invitados as $invitado)
        {
            $proyecto[$i] = $invitado->proyecto_id;
            $i++;
        }
        if ($invitados->isEmpty())
            return; 
        else
        {
            return Proyecto::whereIn('id',$proyecto)->get();
        }
            
    }
}
