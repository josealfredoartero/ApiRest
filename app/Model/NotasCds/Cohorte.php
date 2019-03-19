<?php

namespace App\Model\NotasCds;

use Illuminate\Database\Eloquent\Model;
use App\Model\NotasCds\Curso_nivels;

class Cohorte extends Model
{
    //
    public function CursoNivels(){
        return $this->hasMany(Curso_nivels::class);
    }
}
