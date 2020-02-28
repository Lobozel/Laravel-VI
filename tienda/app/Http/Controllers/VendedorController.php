<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Articulo;
use App\Categoria;

class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendedores = DB::table('vendedores')
        ->orderBy('apellidos')
        ->paginate(4);
        return view("vendedores.index", compact("vendedores"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendedores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendedor=DB::table('vendedores')
        ->where('id', $id)->get()[0];
        
        return view('vendedores.show',compact('vendedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendedor=DB::table('vendedores')
        ->where('id', $id)->get()[0];

        return view('vendedores.edit',compact('vendedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vendedor=DB::table('vendedores')
        ->where('id', $id)->get()[0];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendedor=DB::table('vendedores')
        ->where('id', $id)->get()[0];
    }

    //Otras funciones/recursos
    public function showVentas($id)
    {
        $vendedor=DB::table('vendedores')
        ->where('id', $id)->get()[0];
        
        // $vendidos=DB::table('articulos as a','ventas as v')
        // ->select('a.nombre','v.unidades')
        // ->where('v.articulo_id','a.id')
        // ->where('v.vendedor_id',$id)
        // ->orderBy('v.id');

        $vendidos = DB::select("select a.nombre, a.imagen, v.unidades from articulos as a, ventas as v where articulo_id=a.id and vendedor_id=".$id." order by v.id");
        $total = DB::table('ventas')
        ->where('vendedor_id', $id)
        ->sum('unidades');
        return view('vendedores.ventas',compact('vendedor','vendidos','total'));
    }
}
