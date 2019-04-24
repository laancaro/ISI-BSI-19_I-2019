<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    public $table = "medicamento";
	protected $fillable = [
		'nombre', 'descripcion', 'casa_farmaceutica'

	];
}
