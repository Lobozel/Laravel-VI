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
<!--Búsquedas-->
<form action="{{route('vendedores.index')}}" name="search" method="get" class="form-inline mb-2">
  <table class='container'>
    <tr>
      <td>
        @if (isset($_GET['nombre']))
      <input type='text' name='nombre' placeholder="Buscar por Nombre" value='{{$_GET['nombre']}}'>
        @else
  <input type='text' name='nombre' placeholder="Buscar por Nombre">
        @endif
  @if (isset($_GET['email']))
  <input type='text' name='email' placeholder="Buscar por Email" value='{{$_GET['email']}}'>
  @else
  <input type='text' name='email' placeholder="Buscar por Email">
  @endif
  
  <select name="vendidos" class="form-control" >
    <option value='0'>Cualquier cantidad</option>
    <?php $cont=1; ?>
    @foreach ($ventas as $venta)
    @if(isset($_GET['vendidos']) && $cont==$_GET['vendidos'])
    <option selected="" value="<?php echo $cont ?>">{{$venta}}</option>
  @else
    <option value="<?php echo $cont ?>">{{$venta}}</option>
  @endif
  <?php $cont++; ?>
    @endforeach
   </select> 
  <input type="submit" value="Buscar" class="btn btn-info ml-2">
<!--Orden-->
</td>
<td class='float-center'>
  <select name='campo' onchange="this.form.submit()">
    @foreach ($campos as $campo => $dato)
        @if ((isset($_GET['campo']) && $_GET['campo']==$campo)
        //Asigno que se seleccione el campo por defecto al que yo quiera aún que no sea el primer campo
         || (!isset($_GET['campo']) && $campo=='apellidos'))
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
      <th scope="col" class="align-middle">Email</th>
      <th scope="col" class="align-middle">Imagen</th>
      <th scope="col" class="align-middle">Acciones</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($vendedores as $vendedor)
        <tr>
            <th scope="row align-middle">
                <a href="{{route('vendedores.show', $vendedor)}}" class="btn btn-success fa fa-address-card fa-2x"><i class=""></i></a>
            </th>
            <td class="align-middle">{{$vendedor->apellidos}}, {{$vendedor->nombre}}</td>
            <td class="align-middle">{{$vendedor->email}}</td>
            <td class="align-middle">
            <img src="{{asset($vendedor->foto)}}" class="img-fluid rounded-circle" width="80px" height="80px">
            </td>
            <td class="align-middle" style="white-space: nowrap;">
            <form class="form-inline" name='del' action='{{route('vendedores.destroy', $vendedor)}}' method='POST'>
              @method("DELETE")
              @csrf
              <button type="submit" onclick="return confirm('¿Borrar vendedor?')" class="btn btn-danger fa fa-trash fa-1x"></button>
              <a href="{{route('vendedores.edit',$vendedor)}}" class="ml-2 fa fa-edit fa-1x btn btn-warning"></a>
            </form>
            </td>
        </tr>
      @endforeach
  </tbody>
</table>
{{$vendedores->appends(Request::except("page"))->links()}}  
@endsection