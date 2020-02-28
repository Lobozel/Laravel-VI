@extends('plantillas.plantilla')
@section('titulo')
    {{$articulo->nombre}}
@endsection
@section('cabecera')
    <i><a class='text-dark' href="{{route('categorias.show', $articulo->categoria_id)}}">{{$articulo->categoria->nombre."/"}}</a><b>{{($articulo->nombre)}}</b></i>
@endsection
@section('contenido')
    <span class="clearfix"></span>
    <div class="card text-white bg-info mt-5 mx-auto" style="max-width: 38rem;">
        <div class="card-header text-center"><b>Detalles del Producto</b></div>
        <div class="card-body" style="font-size: 1.1em">
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
                            <label for='precio'>En Stock:&nbsp;&nbsp;</label>
                            @if ($articulo->stock==0)
                            <input class='text-center bg-danger' name='precio' type='text' readonly value="{{$articulo->stock}}" size='1'>
                            @else
                            <input class='text-center bg-success' name='precio' type='text' readonly value="{{$articulo->stock}}" size='1'>
                            @endif
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
                </table>
        </div>
        <a href="#" class="float-left btn btn-secondary">Vender</a>
        <a href="{{route('articulos.index')}}" class="float-left btn btn-success">Volver</a>
    </div>
@endsection