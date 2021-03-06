@extends('layouts.app')

@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="container">
    <div class="row mb-4">
        <div class="col col-7">
            <p class="text-center" style="font-size: x-large">Mis Solicitudes</p>
        </div>
        <div class="col col-2">
            <a class="btn btn-success btn-block" href="solicitud/create"> <i class="fas fa-plus"></i> Nueva
                Solicitud</a>
        </div>
    </div>
    <table class="table table-hover" style="background-color:#DBE2E9">
        <thead>
            <tr>
                <th style="width: 15%" scope="col">Fecha Solicitud</th>
                <th style="width: 20%" scope="col">Numero Solicitud</th>
                <th style="width: 30%" scope="col">Tipo Solicitud</th>
                <th style="width: 20%" scope="col">Estado</th>
                <th style="width: 10%" scope="col">Editar</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($solicitudes as $solicitud)
            <tr>
                <th scope="row">{{ $solicitud->getOriginal()['pivot_updated_at'] }}</th>
                <td>{{ $solicitud->getOriginal()['pivot_id'] }}</td>
                <td>{{$solicitud->tipo}}</td>
                @switch($solicitud->getOriginal()['pivot_estado'])
                @case(0)
                <td>
                    <div class="alert alert-warning" role="alert">
                        Pendiente
                    </div>
                </td>
                @break
                @case(1)
                <td>
                    <div class="alert alert-success" role="alert">
                        Aceptada
                    </div>
                </td>
                @break
                @case(2)
                <td>
                    <div class="alert alert-success" role="alert">
                        Aceptada con observaciones
                    </div>
                </td>
                @break
                @case(3)
                <td>
                    <div class="alert alert-danger" role="alert">
                        Rechazada
                    </div>
                </td>
                @break

                @default

                @endswitch
                <td><a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="editar" href={{
                        route('solicitud.edit', [$solicitud]) }}><i class="far fa-edit"></i></a></td>
            </tr>
            @empty
            <tr>
                <td colspan="5">
                    <p>No hay solicitudes ingresadas</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
