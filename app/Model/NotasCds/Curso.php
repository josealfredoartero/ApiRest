<?php

namespace App\Model\NotasCds;

use Illuminate\Database\Eloquent\Model;
use App\Model\NotasCds\Curso;
use App\Model\NotasCds\promocion;

class Curso extends Model
{
    //permitir que modifique los campos en la tabla
    protected $fillable = ['nombre'];
    public function promocion(){
        return $this->hasMany(promocion::class, 'id');
    }

}
