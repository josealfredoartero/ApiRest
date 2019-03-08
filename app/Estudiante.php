<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Nota;

class Estudiante extends Model
{
    //
    public function promocion(){
        return $this->belongsTo('App\Promocion', 'id');
    }
    public function nota(){
        return $this->hasMany(Nota::class, 'id');
    }
}
