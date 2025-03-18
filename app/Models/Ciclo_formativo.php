<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciclo_formativo extends Model
{
    protected $fillable = [
        'nombre',
        'tipo',
        'departamento_id',
    ];
    public function departamento()
{
    return $this->belongsTo(Departamento::class);
}
public function cursos()
{
    return $this->hasMany(Curso::class);
}
}
