<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'nombre',
        'nif',
        'localidad',
        'provincia',
        'codigo_postal',
        'calle',
        'telefono',
        'email',
        'nombre_tutor',
        'apellidos_tutor',
        'nif_tutor',
        'email_tutor',
    ];

    public function acuerdo()
    {
        return $this->hasOne(Acuerdo::class);
    }
}
