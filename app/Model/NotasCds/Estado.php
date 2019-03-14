<?php

namespace App\Model\NotasCds;

use Illuminate\Database\Eloquent\Model;
use App\Model\NotasCds\Estudiante;

class Estado extends Model
{
    //
    public function estudiante(){
        return $this->hasMany(Estudiante::class, 'id');
    }
}
