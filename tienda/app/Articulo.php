<?php

namespace App;
use App\Categoria;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $fillable=["nombre", "categoria_id", "precio", "stock", "imagen"];

    public function categoria(){
        return $this->belongsTo(Categoria::class)
        ->withDefault(['nombre'=>'Otros']);
    }

    public function vendedores(){
           return $this->belongsToMany("App\Vendedor")->withPivot("unidades")->withTimestamps();
    }
}
