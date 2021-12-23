@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row mb-3">
        <div class="col col-8">
            <p class="text-center" style="font-size: x-large">Solicitudes Finalizadas</p>

        </div>

                    <a href="/GestionSolicitud" class="btn btn-primary" style="color:Black; background-color: #AD7C59; border:#AD7C59">Volver</a>
                </div>
        <div class="col-lg-12 mt-4 text-light login-title" style="font-size: 15px">


    </div>

    <table class="table table-hover" style="background-color:#DBE2E9">
        <thead>
            <tr>

                <th style="width: 10%" scope="col">Fecha y hora</th>
                <th style="width: 25%" scope="col">Numero solicitud</th>
                <th style="width: 25%" scope="col">Rut</th>
                <th style="width: 20%" scope="col">Nombre</th>
                <th style="width: 20%" scope="col" colspan="3">Tipo de solicitud</th>
                <th style="width: 14%" scope="col" colspan="3">Estado</th>


                <tbody>

            @foreach ($usuarios as $usuario)
            @forelse ($usuario->solicitudes as $solicitud)
            @if ($solicitud->pivot->estado != 0)
           
            <tr>
            
                <th scope="row">{{$solicitud->getOriginal()['pivot_updated_at']}}</th>
                <td>{{$solicitud->getOriginal()['pivot_id']}}</td>
                <td>{{$usuario->rut}}</td>
                <td>{{$usuario->name}}</td>
                <td>{{$solicitud->tipo}}</td>
                <td></td>
                <td>@if ($solicitud->pivot->estado == 1)</td>


                                <td>ACEPTADA</td>


                            @endif
                            @if ($solicitud->pivot->estado == 2)

                                <td>ACEPTADA CON OBSERVACIONES</td>


                            @endif
                            @if ($solicitud->pivot->estado == 3)



                                <td>RECHAZADA</td>



                            @endif
                            @if ($solicitud->pivot->estado == 4)


                                <td>ANULADA</td>



                            @endif
                            @if ($solicitud->pivot->estado == 0)

                                <td>PENDIENTE</td>

                            @endif


                <div class="col-lg-12 login-form">
            </tr>
            @endif
            @empty


             @endforelse


            @endforeach

        </tbody>

</div>

@endsection
