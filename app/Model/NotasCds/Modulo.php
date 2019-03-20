<?php

namespace App\Model\NotasCds;

use Illuminate\Database\Eloquent\Model;
use App\Model\NotasCds\docente;
use App\Model\NotasCds\actividad;
use App\Model\NotasCds\nivel;

class Modulo extends Model
{
    //
    // protected $fillable=[];
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
