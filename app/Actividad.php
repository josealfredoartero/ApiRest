<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividades';

    public function modulo(){
        return $this->belongsTo('App\Modulo', 'id');
    }
    public function nota(){
        return $this->belongsTo('App\Nota', 'id');
    }
}
