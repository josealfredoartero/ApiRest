<?php

namespace App\Model\NotasCds;

use Illuminate\Database\Eloquent\Model;
use App\Model\NotasCds\Actividad;

class Nota extends Model
{
    protected $table="notas";

    public function actividad(){
        return $this->belongsTo(Actividad::class);
    }
}