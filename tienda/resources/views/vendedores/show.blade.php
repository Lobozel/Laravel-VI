@extends('plantillas.plantilla')
@section('titulo')
    {{$vendedore->nombre}} {{$vendedore->apellidos}}
@endsection
@section('cabecera')
    <i>Vendedor <b>{{$vendedore->apellidos}}, {{($vendedore->nombre)}}</b></i>
@endsection
@section('contenido')
    <span class="clearfix"></span>
    <div class="card text-white bg-info mt-5 mx-auto" style="max-width: 38rem;">
        <div class="card-header text-center"><b>Detalles del Vendedor</b></div>
        <div class="card-body" style="font-size: 1.1em">
                <table style="width: 35rem;">
                    <tr>                        
                        <td>
                            <b>Nombre:&nbsp;&nbsp;</b>
                            {{$vendedore->nombre}}                            
                        </td>
                        <td rowspan="5">
                            <div class="float-right">
                                <img src="{{asset($vendedore->foto)}}" width="160px" heght="160px" class="rounded-circle">
                            </div>
                        </td>
                    </td>
                    <tr>
                        <td>
                            <b>Apellidos:&nbsp;&nbsp;</b>
                            {{$vendedore->apellidos}}  
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Email:&nbsp;&nbsp;</b>
                            {{$vendedore->email}}  
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Teléfono:&nbsp;&nbsp;</b>
                            {{$vendedore->telefono}}                                
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Dirección:&nbsp;&nbsp;</b>
                            {{$vendedore->direccion}}
                        </td>
                    </tr>
                </table>
        </div>
        <a href="{{route('vendedores.ventas', $vendedore)}}" class="float-left btn btn-secondary">Ventas</a>
        <a href="{{route('vendedores.index')}}" class="float-left btn btn-success">Volver</a>
    </div>
@endsection