<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan_formativo extends Model
{
    protected $fillable = [
        'año_academico',
        'regimen',
        'curso_id',
        'centro_educativo_id',
        'user_id',
        'alumno_id',
        'exencion_parcial',
        'horas_exencion_parcial',
        'realiza_ffe',
        'coordinacion_seguimiento',
        'empresa_id',
        'apoyo',
        'especificar_apoyo',
        'autorizacion_extras',
        'numero_horas',
        'distribucion',
        'fecha_inicio',
        'fecha_fin',
        'hora_inicio',
        'hora_fin',
        'jornada',
        'formacion_especifica',
        'descripcion_formacion_especifica',
        'fecha_firma',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function centro_educativo()
    {
        return $this->belongsTo(Centro_educativo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
  /*  public function ras()
    {
        $this->belongsToMany(Ra::class);
    }*/

    public function ras():HasMany{
        return $this->hasMany(Plan_formativora::class);
    }
}
