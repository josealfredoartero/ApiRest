<?php

namespace App\Model\NotasCds;

use Illuminate\Database\Eloquent\Model;
use App\Model\NotasCds\Nota;

class Estudiante extends Model
{
    //
    public function promocion(){
        return $this->belongsTo(promocion::class, 'id');
    }
    public function nota(){
        return $this->hasMany(Nota::class, 'id');
    }
}
