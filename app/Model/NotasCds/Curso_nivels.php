<?php

namespace App\Model\NotasCds;

use Illuminate\Database\Eloquent\Model;
use App\Model\NotasCds\Cohorte;
use App\Model\NotasCds\Curso;
use App\Model\NotasCds\Nivel;

class Promocion extends Model
{
    //
    protected $table = 'curso_nivels';

    public function cohorte(){
        return $this->belongsTo(Cohorte::class ,'id');
    }

    public function curso(){
        return $this->belongsTo(curso::class,'id');
    }

    public function nivel(){
        return $this->belongsTo(Nivel::class, 'id');
    }

}
// relaciones de uno a uno
// hasOne
// relaciones de uno a muchos
// hasMany
// relaciones de muchos a uno
// belongsTo