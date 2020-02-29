@extends('plantillas.plantilla')
@section("titulo")
Almería - Tienda Online
@endsection
@section("cabecera")
Almería - Tienda Online
@endsection
@section("contenido")
<div class='container text-center'>
<div class="btn-group mt-3" role="group">
    <a href="{{route('articulos.index')}}" class="btn btn-success">Gestionar Articulos</a>
    <a href="{{route('categorias.index')}}" class="btn btn-success">Gestionar Categorias</button>
    <a href="{{route('vendedores.index')}}" class="btn btn-success">Gestionar Vendedores</a>
  </div>
</div>
@endsection