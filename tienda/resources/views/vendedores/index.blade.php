@extends('plantillas.plantilla')
@section("titulo")
Almería - Tienda Online
@endsection
@section("cabecera")
Gestion Vendedores
@endsection
@section("contenido")
@if ($text=Session::get("mensaje"))
    <p class="alert alert-success my-3">{{$text}}</p>
@endif
<a href="{{route('vendedores.create')}}" class="btn btn-info mb-3"><i class="fa fa-plus"></i> Crear vendedor</a>
<form action="{{route('vendedores.index')}}" name="search" method="get" class="form-inline float-right">
  <!--TODO-->
  <!--Búsqueda/s-->
  <input type="submit" value="Buscar" class="btn btn-info ml-2">
</form>
 <table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">Detalles</th>
      <th scope="col" class="align-middle">Nombre</th>
      <th scope="col" class="align-middle">Email</th>
      <th scope="col" class="align-middle">Imagen</th>
      <th scope="col" class="align-middle">Acciones</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($vendedores as $vendedor)
        <tr>
            <th scope="row align-middle">
                <a href="{{route('vendedores.show', $vendedor->id)}}" class="btn btn-success fa fa-address-card fa-2x"><i class=""></i></a>
            </th>
            <td class="align-middle">{{$vendedor->apellidos}},{{$vendedor->nombre}}</td>
            <td class="align-middle">{{$vendedor->email}}</td>
            <td class="align-middle">
            <img src="{{asset($vendedor->imagen)}}" class="img-fluid rounded-circle" width="80px" height="80px">
            </td>
            <td class="align-middle" style="white-space: nowrap;">
            <form class="form-inline" name='del' action='{{route('vendedores.destroy', $vendedor->id)}}' method='POST'>
              @method("DELETE")
              @csrf
              <button type="submit" onclick="return confirm('¿Borrar vendedor?')" class="btn btn-danger fa fa-trash fa-1x"></button>
              <a href="{{route('vendedores.edit',$vendedor->id)}}" class="ml-2 fa fa-edit fa-1x btn btn-warning"></a>
            </form>
            </td>
        </tr>
      @endforeach
  </tbody>
</table>
{{$vendedores->appends(Request::except("page"))->links()}}  
@endsection