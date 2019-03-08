<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    //
    public function docente(){
        return $this->belongsTo('App\Docente', 'id');
    }
    public function actividad(){
        return $this->hasMany('App\Actividad', 'id');
    }
    public function nivel(){
        return $this->belongsTo('App\Nivel', 'id');
    }
}
