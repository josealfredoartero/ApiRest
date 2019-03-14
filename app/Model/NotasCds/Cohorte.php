<?php

namespace App\Model\NotasCds;

use Illuminate\Database\Eloquent\Model;
use App\Model\NotasCds\Promocion;

class Cohorte extends Model
{
    //
    public function promocion(){
        return $this->hasMany(Promocion::class, 'id');
    }
}
