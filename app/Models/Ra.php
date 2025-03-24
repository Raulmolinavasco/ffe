<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

   /* public function plan_formativo(){

        $this->belongsToMany(Plan_formativo::class);

    }*/
  /* public function plan_formativo():HasMany{
        return $this->hasMany(Plan_formativo::class);
    }*/
}
