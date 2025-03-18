<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ra extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'modulo_id',
    ];
    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }
}
