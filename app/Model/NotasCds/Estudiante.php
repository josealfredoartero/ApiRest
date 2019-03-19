<?php

namespace App\Model\NotasCds;

use Illuminate\Database\Eloquent\Model;
use App\Model\NotasCds\Nota;
use App\Model\NotasCds\curso_nivels;
use App\Model\NotasCds\estado;

class Estudiante extends Model
{
    //
    protected $fillable = ['nombres',"apellidos","DUI","fecha_nacimiento","genero","direccion","telefono","email","id_promocion","id_estado"];
    public function curso_nivels(){
        return $this->belongsTo(curso_nivels::class, 'id');
    }
    public function nota(){
        return $this->hasMany(Nota::class, 'id');
    }
    public function estado(){
        return $this->belongsTo(estado::class, 'id');
    }
}
