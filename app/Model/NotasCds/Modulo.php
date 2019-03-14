<?php

namespace App\Model\NotasCds;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    //
    public function docente(){
        return $this->belongsTo(docente::class, 'id');
    }
    public function actividad(){
        return $this->hasMany(actividad::class, 'id');
    }
    public function nivel(){
        return $this->belongsTo(Nivel::class, 'id');
    }
}
