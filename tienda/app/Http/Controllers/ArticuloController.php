<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticuloRequest;
use App\Articulo;
use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArticuloController extends Controller
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
            "stock"=>"Inventario",
            "precio"=>"Precio"
        ];
        $precios=['Menos de 10€',
        'De 10€ a 50€',
        'De 50€ a 100€',
        'Más de 100€'];
        //Por defecto
        $campo='id';
        $orden='asc';

        $nombre=trim(strtolower($request->get('nombre')));
        $categoria=$request->get('categoria');
        $precio=$request->get('precio');

        //Cambiado por el usuario
        if(isset($request->campo)){
            $campo=$request->campo;
        }

        if(isset($request->order)){
            $orden=$request->order;
        }        
        
        $articulos = Articulo::orderBy($campo, $orden)
        ->nombre($nombre)
        ->categoria($categoria)
        ->precio($precio)
        ->paginate(4);
        $categorias = Categoria::all();
        return view("articulos.index", compact("articulos", "categorias","precios","campos","request"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('articulos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticuloRequest $request)
    {
        $datos=$request->validated();

        $articulo = new Articulo;
        $articulo->nombre=$datos['nombre'];
        $articulo->categoria_id=$request->categoria;
        $articulo->precio=$datos['precio'];
        if($request->stock!=null)
        $articulo->stock=$request->stock;
        $articulo->descripcion=$request->descripcion;

        if($request->has('imagen')){
            $request->validate([
                'imagen'=>['image']
            ]);
            $file=$request->file('imagen');
            $nombre='articulos/'.time().'_'.$file->getClientOriginalName();
            Storage::disk('public')->put($nombre, \File::get($file));
            
            $articulo->imagen="img/$nombre";
        }
        $articulo->save();

        return redirect()
        ->route('articulos.index')
        ->with('mensaje','Artículo creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show(Articulo $articulo)
    {
        return view("articulos.show", compact("articulo"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Articulo $articulo)
    {
        $categorias = Categoria::all();
        return view('articulos.edit',compact('articulo','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articulo $articulo)
    {
        $request->validate([
            'nombre'=>['required'],
            'precio'=>['required']
        ]);

        if($request->has('imagen')){
            $request->validate([
                'imagen'=>['image']
            ]);
            $file=$request->file('imagen');
            $nombre='articulos/'.time().'_'.$file->getClientOriginalName();
            Storage::disk('public')->put($nombre, \File::get($file));
            if(basename($articulo->imagen)!='default.png'){
                unlink(public_path().'/'.$articulo->imagen);
            }
            $articulo->update($request->all());
            $articulo->update(['imagen'=>"img/$nombre"]);
        }else{
        $articulo->update($request->all());
        }
        $articulo->update();

        return redirect()
        ->route('articulos.index')
        ->with('mensaje','Artículo creado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articulo $articulo)
    {
        if(basename($articulo->imagen)!='default.png'){
            unlink(public_path().'/'.$articulo->imagen);
        }
        $articulo->delete();
        return redirect()
        ->route('articulos.index')
        ->with('mensaje','Artículo borrado');
    }

    //Otras funciones/recursos
    public function vender(Articulo $articulo)
    {
        $vendedores = DB::table('vendedores')
        ->orderBy('apellidos')
        ->get();
        return view('articulos.vender',compact('articulo','vendedores'));
    }

    public function updateVenta(Request $request)
    {
        $registro = DB::select("select id, unidades from ventas where articulo_id=".$request->articulo." and vendedor_id=".$request->vendedores);

        if(empty($registro)){
            //No existe, creo registro
            DB::table('ventas')->insert([
                'articulo_id' => $request->articulo,
                'vendedor_id' => $request->vendedores,
                'unidades' => $request->stock,
                "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                ]
            );
        }else{
            //Existe, actualizo registro
            DB::table('ventas')
            ->where('id', $registro[0]->id)
            ->update(['unidades' => $registro[0]->unidades+$request->stock]);            
        }

        //Actualizo el stock del articulo
        DB::table('articulos')
            ->where('id', $request->articulo)
            ->update(['stock' => $request->stockInicial-$request->stock]);

        return redirect()->route('articulos.index')->with("mensaje","Se han vendido ".$request->stock." unidades del artículo ".$request->nombre); 
    }

    public function addStock(Articulo $articulo)
    {
        return view('articulos.addstock',compact('articulo'));
    }

    public function updateStock(Request $request)
    {
        //Actualizo el stock del articulo
        DB::table('articulos')
            ->where('id', $request->articulo)
            ->update(['stock' => $request->stockInicial+$request->stock]);

        return redirect()->route('articulos.index')->with("mensaje","Se han añadido ".$request->stock." unidades al inventario del artículo ".$request->nombre); 
    }
}
