<?php

namespace App\Model\NotasCds;

use Illuminate\Database\Eloquent\Model;
use App\Model\NotasCds\Curso_nivels;

class Curso extends Model
{
    //permitir que modifique los campos en la tabla
    protected $fillable = ['nombre'];
    public function Curso_nivels(){
        return $this->hasMany(Curso_nivels::class, 'id');
    }
}
