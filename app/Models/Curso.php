<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = [
        'nombre',
        'ciclo_formativo_id',
    ];

    public function ciclo_formativo()
{
    return $this->belongsTo(Ciclo_formativo::class);
}
public function modulos()
{
    return $this->hasMany(Modulo::class);
}

public function alumnos()
{
    return $this->hasMany(Alumno::class);
}
}
