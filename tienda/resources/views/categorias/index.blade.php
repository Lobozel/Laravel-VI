@extends('plantillas.plantilla')
@section("titulo")
Almería - Tienda Online
@endsection
@section("cabecera")
Gestion Categorias
@endsection
@section("contenido")
@if ($text=Session::get("mensaje"))
    <p class="alert alert-success my-3">{{$text}}</p>
@endif
<a href="{{route('categorias.create')}}" class="btn btn-info mb-3"><i class="fa fa-plus"></i> Crear categoria</a>
<form action="{{route('categorias.index')}}" name="search" method="get" class="form-inline float-right">
  <!--TODO-->
  <!--Búsqueda/s-->
  <input type="submit" value="Buscar" class="btn btn-info ml-2">
</form>
 <table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">Detalles</th>
      <th scope="col" class="align-middle">Nombre</th>
      <th scope="col" class="align-middle">Logo</th>
      <th scope="col" class="align-middle">Acciones</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($categorias as $categoria)
        <tr>
            <th scope="row align-middle">
                <a href="{{route('categorias.show', $categoria)}}" class="btn btn-success fa fa-address-card fa-2x"><i class=""></i></a>
            </th>
            <td class="align-middle">{{$categoria->nombre}}</td>
            <td class="align-middle">
            <img src="{{asset($categoria->logo)}}" class="img-fluid rounded-circle" title='{{$categoria->descripcion}}' width="80px" height="80px">
            </td>
            <td class="align-middle" style="white-space: nowrap;">
            <form class="form-inline" name='del' action='{{route('categorias.destroy', $categoria)}}' method='POST'>
              @method("DELETE")
              @csrf
              <button type="submit" onclick="return confirm('¿Borrar categoria?')" class="btn btn-danger fa fa-trash fa-1x"></button>
              <a href="{{route('categorias.edit',$categoria)}}" class="ml-2 fa fa-edit fa-1x btn btn-warning"></a>
            </form>
            </td>
        </tr>
      @endforeach
  </tbody>
</table>
{{$categorias->appends(Request::except("page"))->links()}}
@endsection