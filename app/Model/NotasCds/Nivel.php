<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Promocion;
use App\Modelo;

class Nivel extends Model
{
    // espesificar la tabla de la base de datos
    protected $table = 'niveles';

    public function promocion(){
        return $this->hasMany(Promocion::class, 'id');
    }
    public function modulo(){
        return $this->hasMany(Modulo::class, 'id');
    }
}
