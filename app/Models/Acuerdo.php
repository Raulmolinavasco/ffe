<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acuerdo extends Model
{
    protected $fillable = [
        'acuerdo_numero',
        'centro_educativo_id',
        'empresa_id',
        'seguridad_social',
        'acuerdo_fecha',
    ];

    public function centro_educativo()
{
    return $this->belongsTo(Centro_educativo::class);
}
public function empresa()
{
    return $this->belongsTo(Empresa::class);
}

}
