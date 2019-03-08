<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\modulo;

class Docente extends Model
{
    public function modulo(){
        return $this->hasMany(Modulo::class, 'id');
    }
}
