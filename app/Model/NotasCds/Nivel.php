<?php

namespace App\Model\NotasCds;

use Illuminate\Database\Eloquent\Model;
use App\Model\NotasCds\Curso_nivels;
use App\Model\NotasCds\Modulo;

class Nivel extends Model
{
    // espesificar la tabla de la base de datos
    protected $table = 'nivels';

    public function CursoNivels(){
        return $this->hasMany(Curso_nivels::class);
    }
    public function modulo(){
        return $this->hasMany(Modulo::class);
    }
}
