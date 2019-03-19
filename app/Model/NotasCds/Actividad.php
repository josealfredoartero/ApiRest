<?php

namespace App\Model\NotasCds;

use Illuminate\Database\Eloquent\Model;
use App\Model\NotasCds\Modulo;
use App\Model\NotasCds\Nota;

class Actividad extends Model
{
    protected $table = 'actividads';

    public function modulo(){
        return $this->belongsTo(Modulo::class, 'id');
    }
    public function nota(){
        return $this->hasMany(Nota::class, 'id');
    }
}
