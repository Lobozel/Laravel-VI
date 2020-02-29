<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendedorRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Vendedor;
use App\Articulo;
use App\Categoria;
use Illuminate\Support\Facades\Storage;

class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $campos=[
            "id"=>"Publicación",
            "nombre"=>"Nombre",
            "apellidos"=>"Apellidos",
            "ventas"=>"ventas"
        ];
        $ventas=['Menos de 10',
        'De 10 a 50',
        'De 50 a 100',
        'Más de 100'];
        //Por defecto
        $campo='apellidos';
        $orden='asc';

        $nombre=trim(strtolower($request->nombre));
        $email=trim(strtolower($request->email));
        $vendido=$request->get('vendidos');

        //Cambiado por el usuario
        if(isset($request->campo)){
            $campo=$request->campo;
        }

        if(isset($request->order)){
            $orden=$request->order;
        }

        if($campo=='ventas'){
            $vendedores = Vendedor::join('ventas', 'ventas.vendedor_id','=','vendedores.id')
            ->selectRaw('vendedores.*, sum(unidades) as vendidos')
            ->groupBy('vendedores.id')
            ->orderBy('vendidos', $orden)
            ->nombre($nombre)
            ->email($email)
            ->ventas($vendido)
            ->paginate(4);
        }else{
            $vendedores = Vendedor::orderBy($campo, $orden)
            ->nombre($nombre)
            ->email($email)
            ->ventas($vendido)
            ->paginate(4);
        }
        
        return view("vendedores.index", compact("vendedores","campos","ventas","request"));
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
    public function store(VendedorRequest $request)
    {
        $datos=$request->validated();

        $vendedor = new Vendedor;
        $vendedor->nombre=$datos['nombre'];
        $vendedor->apellidos=$datos['apellidos'];
        $vendedor->email=$datos['email'];
        $vendedor->direccion=$request->direccion;
        $vendedor->telefono=$request->telefono;
            
        if($request->has('foto')){
            $request->validate([
                'foto'=>['image']
            ]);
            $file=$request->file('foto');
            $nombre='vendedores/'.time().'_'.$file->getClientOriginalName();
            Storage::disk('public')->put($nombre, \File::get($file));

            $vendedor->foto="img/$nombre";
        }
        $vendedor->save();

        return redirect()
        ->route('vendedores.index')
        ->with('mensaje','Vendedor dado de alta');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendedor $vendedore)
    {
        return view('vendedores.show',compact('vendedore'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendedor $vendedore)
    {
        return view('vendedores.edit',compact('vendedore'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendedor $vendedore)
    {
        $request->validate([
            'nombre'=>['required'],
            'apellidos'=>['required'],
            'email'=>['required', 'unique:vendedores,email,'.$vendedore->id]
        ]);
            
        if($request->has('foto')){
            $request->validate([
                'foto'=>['image']
            ]);
            $file=$request->file('foto');
            $nombre='vendedores/'.time().'_'.$file->getClientOriginalName();
            Storage::disk('public')->put($nombre, \File::get($file));
            if(basename($vendedore->foto)!='default.png'){
                unlink(public_path().'/'.$vendedore->foto);
            }
            $vendedore->update($request->all());
            $vendedore->update(['foto'=>"img/$nombre"]);
        }else{
            $vendedore->update($request->all());
        }
        $vendedore->update();

        return redirect()
        ->route('vendedores.index')
        ->with('mensaje','Vendedor actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendedor $vendedore)
    {
        if(basename($vendedore->foto)!='default.png'){
            unlink(public_path().'/'.$vendedore->foto);
        }
        $vendedore->delete();
        return redirect()
        ->route('vendedores.index')
        ->with('mensaje','Vendedor borrado');
    }

    //Otras funciones/recursos
    public function showVentas(Vendedor $vendedore)
    {
        $vendidos = DB::select("select a.nombre, a.id, v.unidades from articulos as a, ventas as v where articulo_id=a.id and vendedor_id=".$vendedore->id." order by v.id;");
        $total = DB::table('ventas')
        ->where('vendedor_id', $vendedore->id)
        ->sum('unidades');
        return view('vendedores.ventas',compact('vendedore','vendidos','total'));
    }
}
