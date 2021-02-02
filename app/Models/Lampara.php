<?php

namespace Familiaris;

use Illuminate\Database\Eloquent\Model;

class Lampara extends Model
{
	protected $table = 'lamparas';
	protected $fillable = ['on'];
}
