<?php

namespace App\Model\NotasCds;

use Illuminate\Database\Eloquent\Model;
use App\Model\NotasCds\Nota;
use App\Model\NotasCds\promocion;
use App\Model\NotasCds\estado;

class Estudiante extends Model
{
    //
    protected $fillable = ['nombres',"apellidos","DUI","fecha_nacimiento","genero","direccion","telefono","email","id_promocion","id_estado"];
    public function promocion(){
        return $this->belongsTo(promocion::class, 'id');
    }
    public function nota(){
        return $this->hasMany(Nota::class, 'id');
    }
}
