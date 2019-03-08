<?php

namespace App\Model\NotasCds;

use Illuminate\Database\Eloquent\Model;
use App\Cohorte;
use App\Curso;
use App\Nivel;
use App\Estudiante;

class Promocion extends Model
{
    //
    protected $table = 'promociones';

    public function cohorte(){
        return $this->belongsTo('App\Cohorte','id');
    }

    public function curso(){
        return $this->belongsTo('App\Curso','id');
    }

    public function nivel(){
        return $this->belongsTo('App\Nivel', 'id');
    }
    public function estudiantes(){
        return $this->hasMany(estudiante::class, 'id');
    }

}
// relaciones de uno a uno
// hasOne
// relaciones de uno a muchos
// hasMany
// relaciones de muchos a uno
// belongsTo