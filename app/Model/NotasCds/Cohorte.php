<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Promocion;

class Cohorte extends Model
{
    //
    public function promocion(){
        return $this->hasMany(Promocion::class, 'id');
    }
}
