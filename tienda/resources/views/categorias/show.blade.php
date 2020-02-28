@extends('plantillas.plantilla')
@section('titulo')
    {{$categoria->nombre}}
@endsection
@section('contenido')
    <span class="clearfix"></span>
    <div class="card text-white bg-info mt-5 mx-auto" style="max-width: 38rem;">
        <div class="card-header text-center"><b>Detalles de la Categoria</b></div>
        <div class="card-body" style="font-size: 1.1em">
                <table style="width: 35rem;">
                    <tr>
                        <td>
                            <div>
                                <img src="{{asset($categoria->logo)}}" width="160px" heght="160px" class="rounded-circle">
                            </div>
                        </td>
                        <td class="text-center">
                            <b>Categoria:&nbsp;&nbsp;{{$categoria->nombre}}</b>
                        </td>
                    </td>                    
                    <tr>
                        <td colspan="2">
                            <b>Descripción:</b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            {{$categoria->descripcion}}
                        </td>
                    </tr>
                </table>
        </div>
        <a href="javascript:history.back()" class="float-left btn btn-success">Volver</a>
    </div>
@endsection