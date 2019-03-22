<?php

namespace App\Model\NotasCds;

use Illuminate\Database\Eloquent\Model;
use App\Model\NotasCds\Docente;
use App\Model\NotasCds\Actividad;
use App\Model\NotasCds\Nivel;

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
