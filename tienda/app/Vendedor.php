<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $fillable=["nombre", "apellidos", "email", "direccion", "telefono", "imagen"];

    public function articulos(){
        return $this->belongsToMany("App\Articulo")->withPivot("unidades")->withTimestamps();
    }
}
