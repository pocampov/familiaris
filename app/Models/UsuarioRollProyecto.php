<?php

namespace Familiaris;

use Illuminate\Database\Eloquent\Model;

class UsuarioRollProyecto extends Model
{
    protected $fillable = ['email_usuario','email_invitado','tipo_rol','proyecto_id'];
    protected $table = 'usuario-roll-proyectos';

	
    public function roles()
    {
        return $this->hasOne(Roll::class,'id','rol_id');
    }
    public function proyectos()
    {
        return $this->hasOne(Proyecto::class,'id','proyecto_id');
    }
    public function usuarios()
    {
        return $this->hasOne(User::class,'email','email_usuario');
    }
 }
