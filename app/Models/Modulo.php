<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'curso_id',
    ];
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
    public function ras()
{
    return $this->hasMany(Ra::class);
}
}
