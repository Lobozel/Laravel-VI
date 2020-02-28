@extends('plantillas.plantilla')
@section('titulo')
Editar {{$vendedor->nombre}} {{$vendedor->apellidos}}
@endsection
@section('cabecera')
Actualizar información de {{$vendedor->apellidos}}, {{$vendedor->nombre}}
@endsection
@section('contenido')
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $miError)
            <li>{{$miError}}</li>
            @endforeach
        </ul>
    </div>
@endif
<form name="c" method='POST' action="{{route('vendedores.update', $vendedor->id)}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
      <div class="col">
        <input type="text" class="form-control" value="{{$vendedor->nombre}}" name='nombre' required>
      </div>
      <div class="col">
        <input type="text" class="form-control" value="{{$vendedor->apellidos}}" name='apellidos' required>
      </div>
    </div>
    <div class="form-row mt-3">    
          <div class="col">
            <input type="text" class="form-control" value="{{$vendedor->email}}" name="email" required>
          </div>
          <div class="col">
            <input type="text" class="form-control" value="{{$vendedor->telefono}}" name="telefono" >
          </div>
      </div>
      <div class="form-row mt-3">
        <input type="text" class="form-control" value="{{$vendedor->direccion}}" name="direccion" >
      </div>
      <div class="form-row mt-3">
        <div class="col">
          <img src="{{asset($vendedor->imagen)}}" width="150vw" height="150vh" class='rounded-circle mr-3'>
          <b>Imagen</b>&nbsp;<input type='file' name='imagen' accept="image/*">
        </div>
      </div>
      <div class="form-row mt-3">
        <div class="col">
            <input type='submit' value='Guardar' class='btn btn-success mr-3'>
            <input type='reset' value='Limpiar' class='btn btn-warning mr-3'>
            <a href={{route('vendedores.index')}} class='btn btn-info'>Volver</a>
        </div>
    </div>
  </form>
@endsection 