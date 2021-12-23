@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row mb-3">
        <div class="col col-8">
            <p class="text-center" style="font-size: x-large">Solicitudes </p>

        </div>

    </div>

    <table class="table table-hover" style="background-color:#DBE2E9">
        <thead>
            <tr>

                <th style="width: 10%" scope="col">Fecha y hora</th>
                <th style="width: 25%" scope="col">Numero solicitud</th>
                <th style="width: 25%" scope="col">Rut</th>
                <th style="width: 20%" scope="col">nombre</th>
                <th style="width: 20%" scope="col" colspan="3">Tipo de solicitud</th>

                <tbody>

            @foreach ($usuarios as $usuario)

            @forelse ($usuario->solicitudes as $solicitud)
            @if ($solicitud->pivot->estado == 0)
            <tr>

                <th scope="row">{{$usuario->created_at}}</th>
                <td>{{$solicitud->getOriginal()['pivot_id']}}</td>
                <td>{{$usuario->rut}}</td>
                <td>{{$usuario->name}}</td>
                <td>{{$solicitud->tipo}}</td>
                <td><a class="btn btn-info" href={{ route('verNumero',
                                    ['id'=>$solicitud->getOriginal()['pivot_id'], 'alumno_id' => $usuario->id])
                                    }}>Ver</a></td>
                <div class="col-lg-12 login-form">
                <div class="col-lg-12 login-form">
            </tr>

            @endif
            @if (!$solicitud)
            <tr>
                <td colspan="5">
                    <p>No hay solicitudes ingresadas</p>
                </td>
            </tr>
            @endif
            @empty


            @endforelse

            @endforeach

        </tbody>

</div>

@endsection
