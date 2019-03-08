<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Actividad;

class Nota extends Model
{

    public function actividad(){
        return $this->hasMany(Actividad::class, 'id');
    }
}
