@extends('plantillas.plantilla')
@section("titulo")
Almería - Tienda Online
@endsection
@section("cabecera")
Gestion Articulos
@endsection
@section("contenido")
@if ($text=Session::get("mensaje"))
    <p class="alert alert-success my-3">{{$text}}</p>
@endif
<a href="{{route('articulos.create')}}" class="btn btn-info mb-3"><i class="fa fa-plus"></i> Crear articulo</a>
<!--Búsquedas-->
<form name="search" method="get" action="{{route('articulos.index')}}" class="form-inline mb-2">
<table class='container'>
  <tr>
    <td>
  <i class="fa fa-search fa-2x ml-2 mr-2" aria-hidden="true"></i>
  <input type='text' name='nombre' placeholder="Buscar por Nombre">&nbsp;
   <select name='categoria' class='form-control mr-2' >
    <option value='%'>Todas categorias</option>
    @foreach($categorias as $categoria)
      @if($categoria->id==$request->categoria)
        <option value='{{$categoria->id}}' selected>{{$categoria->nombre}}</option>
      @else
        <option value='{{$categoria->id}}'>{{$categoria->nombre}}</option>
      @endif
    @endforeach
  </select> 
  <select name="precio" class="form-control" >
  <option value='0'>Todos precios</option>
  <?php $cont=1; ?>
  @foreach ($precios as $precio)
  @if($cont==$request->precio)
  <option selected="" value="<?php echo $cont ?>">{{$precio}}</option>
@else
  <option value="<?php echo $cont ?>">{{$precio}}</option>
@endif
<?php $cont++; ?>
  @endforeach
 </select> 
  <input type="submit" value="Buscar" class="btn btn-info ml-2">
{{-- </form> --}}
<!--Orden-->
</td>
<td class='float-center'>
{{-- <form action="{{route('articulos.index')}}" name="search" method="get" class="form-inline mb-1"> --}}  
  <select name='campo' onchange="this.form.submit()">
    @foreach ($campos as $campo => $dato)
        @if (isset($_GET['campo']) && $_GET['campo']==$campo)
  <option selected value='{{$campo}}'>{{$dato}}</option>
        @else
  <option value='{{$campo}}'>{{$dato}}</option>
        @endif
    @endforeach
  </select>
  <button onclick='this.form.submit()' class='btn btn-primary fa fa-arrow-down' name='order' value='desc'></button>
  <button onclick='this.form.submit()' class='btn btn-danger fa fa-arrow-up' name='order' value='asc'></button>
</td>
</tr>
</table>
</form>
 <table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">Detalles</th>
      <th scope="col" class="align-middle">Nombre</th>
      <th scope="col" class="align-middle">Categoria</th>
      <th scope="col" class="align-middle">Imagen</th>
      <th scope="col" class="align-middle">Acciones</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($articulos as $articulo)
        <tr>
            <th scope="row align-middle">
                <a href="{{route('articulos.show', $articulo)}}" class="btn btn-success fa fa-address-card fa-2x"><i class=""></i></a>
            </th>
            <td class="align-middle">{{$articulo->nombre}}</td>
            <td class="align-middle">{{$articulo->categoria->nombre}}</td>
            <td class="align-middle">
            <img src="{{asset($articulo->imagen)}}" class="img-fluid rounded-circle" title='{{$articulo->descripcion}}' width="80px" height="80px">
            </td>
            <td class="align-middle" style="white-space: nowrap;">
            <form class="form-inline" name='del' action='{{route('articulos.destroy', $articulo)}}' method='POST'>
              @method("DELETE")
              @csrf
              <button type="submit" onclick="return confirm('¿Borrar articulo?')" class="btn btn-danger fa fa-trash fa-1x"></button>
              <a href="{{route('articulos.edit',$articulo)}}" class="ml-2 fa fa-edit fa-1x btn btn-warning"></a>
            </form>
            </td>
        </tr>
      @endforeach
  </tbody>
</table>
{{$articulos->appends(Request::except("page"))->links()}}
@endsection