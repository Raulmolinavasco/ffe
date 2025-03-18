<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Centro_educativo extends Model
{
    protected $fillable = [
        'nombre',
        'nif',
        'email',
        'telefono',
        'codigo_centro',
        'localidad',
        'provincia',
        'calle',
        'codigo_postal',
        'nombre_director',
        'apellidos_director',
        'nif_director',
    ];

    public function acuerdo()
    {
        return $this->Hasmany(Acuerdo::class);
    }
}
