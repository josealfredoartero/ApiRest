<?php

namespace App\Model\NotasCds;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividades';

    public function modulo(){
        return $this->belongsTo(Modulo::class, 'id');
    }
    public function nota(){
        return $this->belongsTo(Nota::class, 'id');
    }
}
