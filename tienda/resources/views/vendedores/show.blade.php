@extends('plantillas.plantilla')
@section('titulo')
    {{$vendedor->nombre}} {{$vendedor->apellidos}}
@endsection
@section('cabecera')
    <i>Vendedor <b>{{$vendedor->apellidos}}, {{($vendedor->nombre)}}</b></i>
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
                            {{$vendedor->nombre}}                            
                        </td>
                        <td rowspan="5">
                            <div class="float-right">
                                <img src="{{asset($vendedor->imagen)}}" width="160px" heght="160px" class="rounded-circle">
                            </div>
                        </td>
                    </td>
                    <tr>
                        <td>
                            <b>Apellidos:&nbsp;&nbsp;</b>
                            {{$vendedor->apellidos}}  
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Email:&nbsp;&nbsp;</b>
                            {{$vendedor->email}}  
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Teléfono:&nbsp;&nbsp;</b>
                            {{$vendedor->telefono}}                                
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Dirección:&nbsp;&nbsp;</b>
                            {{$vendedor->direccion}}
                        </td>
                    </tr>
                </table>
        </div>
        <a href="#" class="float-left btn btn-secondary">Ventas</a>
        <a href="{{route('vendedores.index')}}" class="float-left btn btn-success">Volver</a>
    </div>
@endsection