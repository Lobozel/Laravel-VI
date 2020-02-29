@extends('plantillas.plantilla')
@section('titulo')
    Vender {{$articulo->nombre}}
@endsection
@section('cabecera')
    <i><a class='text-dark' href="{{route('categorias.show', $articulo->categoria_id)}}">{{$articulo->categoria->nombre."/"}}</a><b>{{($articulo->nombre)}}</b></i>
@endsection
@section('contenido')
    <span class="clearfix"></span>
    @if ($articulo->stock==0)
    <div class="card bg-danger mt-5 mx-auto" style="max-width: 38rem;">
        <div class="card-body" style="font-size: 1.1em">
            <h2 class='text-warning'>¡No quedan unidades de este artículo!</h2>        
    @else        
    <div class="card text-white bg-info mt-5 mx-auto" style="max-width: 38rem;">
        <div class="card-header text-center"><b>Venta del Producto</b></div>
        <div class="card-body" style="font-size: 1.1em">                    
            <form method='POST' action="{{route('articulos.updateVenta')}}">
                @csrf
                <table style="width: 35rem;">
                    <tr>
                        <td rowspan="3">
                            <div>
                                <img src="{{asset($articulo->imagen)}}" width="160px" heght="160px" class="rounded-circle">
                            </div>
                        </td>
                        <td class="text-center">
                            <b>Categoria:&nbsp;&nbsp;
                                <a class='text-dark' href="{{route('categorias.show', $articulo->categoria->id)}}">
                                        {{$articulo->categoria->nombre}}
                                </a>
                            </b>
                        </td>
                    </td>
                    <tr>
                        <td class='text-right'>
                            <label for='precio'>Precio:&nbsp;&nbsp;</label>
                            <input class='text-right bg-warning' name='precio' type='text' readonly value="{{$articulo->precio}}€" size='5'>
                            &nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td class='text-right'>
                            <label for='stock'>En Stock:&nbsp;&nbsp;</label>
                            <input class='text-center' name='stock' type='number' value="{{$articulo->stock}}" size='1' min='1' max='{{$articulo->stock}}' step='1'>
                            Unidades&nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Descripción:</b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            {{$articulo->descripcion}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr>
                            <b>Vendedor:</b>    
                                <select name='vendedores' class="form-control">
                                    @foreach ($vendedores as $vendedor)
                                <option value='{{$vendedor->id}}'>{{$vendedor->apellidos}}, {{$vendedor->nombre}}</option>
                                    @endforeach
                              </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type='submit' class='form-control btn btn-warning' value='Vender'>
                            <input type='hidden' name='articulo' value='{{$articulo->id}}'>
                            <input type='hidden' name='nombre' value='{{$articulo->nombre}}'>
                            <input type='hidden' name='stockInicial' value='{{$articulo->stock}}'>
                        </td>
                    </tr>
                </table>
    </form>
        @endif        
    </div>
    <a href="{{route('articulos.show', $articulo)}}" class="float-left btn btn-secondary">Volver al Producto</a>
        <a href="{{route('articulos.index')}}" class="float-left btn btn-success">Volver</a>
        </div>
@endsection