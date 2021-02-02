<?php

namespace Familiaris;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    protected $fillable = ['nombre'];
    protected $table = 'unidades';
	
	public function proyecto() {
		return $this->belongsTo(Proyecto::class);
	}
}
