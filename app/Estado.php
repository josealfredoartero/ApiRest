<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Estudiante;

class Estado extends Model
{
    //
    public function estudiante(){
        return $this->hasMany(Estudiante::class, 'id');
    }
}
