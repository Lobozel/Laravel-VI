<?php

namespace App;
use Articulo;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable=["nombre", "descripcion","logo"];

    public function articulos(){
        return $this->hasMany(Articulo::class);
    }
}
