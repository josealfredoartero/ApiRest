<?php

namespace App\Model\NotasCds;

use Illuminate\Database\Eloquent\Model;
use App\Model\NotasCds\Curso_nivels;
use App\Model\NotasCds\estudiante;

class Cohorte extends Model
{
    //
    public function Curso_nivels(){
        return $this->hasMany(Curso_nivels::class);
    }
    public function estudiante(){
        return $this->hasMany(estudiante::class);
    }
}
