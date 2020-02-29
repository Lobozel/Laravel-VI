<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre=trim(strtolower($request->get('nombre')));

        $categorias = Categoria::orderBy('nombre')
        ->nombre($nombre)
        ->paginate(3);
        return view("categorias.index", compact("categorias",'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaRequest $request)
    {
        $datos=$request->validated();

        $categoria = new Categoria;
        $categoria->nombre = $datos['nombre'];
        $categoria->descripcion = $request->descripcion;
        
        if($request->has('logo')){
            $request->validate([
                'logo'=>['image']
            ]);
            $file=$request->file('logo');
            $nombre='categorias/'.time().'_'.$file->getClientOriginalName();
            Storage::disk('public')->put($nombre, \File::get($file));

            $categoria->logo="img/$nombre";
        }

        $categoria->save();
        return redirect()
        ->route('categorias.index')
        ->with('mensaje','Categoria creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        return view("categorias.show", compact("categoria"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit',compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre'=>['required']
        ]);

        if($request->has('logo')){
            $request->validate([
                'logo'=>['image']
            ]);
            $file=$request->file('logo');
            $nombre='categorias/'.time().'_'.$file->getClientOriginalName();
            Storage::disk('public')->put($nombre, \File::get($file));
            if(basename($categoria->logo)!='default.png'){
                unlink(public_path().'/'.$categoria->logo);
            }
            $categoria->update($request->all());
            $categoria->update(['logo'=>"img/$nombre"]);
        }else{
        $categoria->update($request->all());
        }
        $categoria->update();

        return redirect()
        ->route('categorias.index')
        ->with('mensaje','Categoria actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $logo=$categoria->logo;
        if(basename($logo)!='default.png'){
            unlink(public_path().'/'.$logo);
        }
        $categoria->delete();
        return redirect()
        ->route('categorias.index')
        ->with('mensaje','Categoria borrada');
    }
}
