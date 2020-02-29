<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = 'vendedores';
    
    protected $fillable=["nombre", "apellidos", "email", "direccion", "telefono", "foto"];

    public function articulos(){
        return $this->belongsToMany("App\Articulo")->withPivot("unidades")->withTimestamps();
    }

    public function scopeNombre($query, $v){
        return $query
        ->where('nombre','like',"%$v%")
        ->orwhere('apellidos','like',"%$v%");
    }

    public function scopeEmail($query, $v){
        return $query->where('email','like',"%$v%");
    }
    
    public function scopeVentas($query, $v){
        // return $query->join('ventas', 'ventas.vendedor_id','=','vendedores.id')
        // ->havingRaw('sum(unidades)>50')
        // ->groupBy('vendedor_id');

        switch($v){
            case 0:
                return $query;
            break;
                    case 1:
                        return $query->join('ventas', 'ventas.vendedor_id','=','vendedores.id')
        ->havingRaw('sum(unidades)<10')
        ->groupBy('vendedor_id');
                    break;
                    case 2:
                        return $query->join('ventas', 'ventas.vendedor_id','=','vendedores.id')
        ->havingRaw('sum(unidades)>10 and sum(unidades)<50')
        ->groupBy('vendedor_id');
                    break;
                    case 3:
                        return $query->join('ventas', 'ventas.vendedor_id','=','vendedores.id')
        ->havingRaw('sum(unidades)>50 and sum(unidades)<100')
        ->groupBy('vendedor_id');
                    break;
                    case 4:
                        return $query->join('ventas', 'ventas.vendedor_id','=','vendedores.id')
        ->havingRaw('sum(unidades)>100')
        ->groupBy('vendedor_id');
                    break;
                }
    }
}
