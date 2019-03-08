<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Curso;

class Curso extends Model
{
    //permitir que modifique los campos en la tabla
    protected $fillable = ['nombre'];
    public function promocion(){
        return $this->hasMany(promocion::class, 'id');
    }

}
