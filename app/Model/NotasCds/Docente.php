<?php

namespace App\Model\NotasCds;

use Illuminate\Database\Eloquent\Model;
use App\Model\NotasCds\modulo;

class Docente extends Model
{
    public function modulo(){
        return $this->hasMany(Modulo::class, 'id');
    }
}
