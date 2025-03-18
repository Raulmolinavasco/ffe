<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $fillable = [
        'nombre',
        'jefe_departamento',
    ];

public function ciclo_formativos()
{
    return $this->hasMany(Ciclo_formativo::class);
}
}
