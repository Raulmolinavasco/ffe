<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $fillable = [
        'nombre',
        'apellidos',
        'nif',
        'email',
        'telefono',
        'localidad',
        'provincia',
        'calle',
        'codigo_postal',
        'nuss',
        'curso_id',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

}
