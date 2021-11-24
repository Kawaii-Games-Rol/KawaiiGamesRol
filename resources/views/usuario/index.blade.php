@extends('layouts.app')

@section('content')

@if (Auth::user()->rol == 'Administrador')
<div class="container">
    <div class="row mb-3">
        <div class="col col-3" >
            <form class="form-inline my-2 my-lg-0" method="GET" action="{{ route('usuario.index') }}">
                <input class="form-control mr-sm-2" name="search" id="search" type="search" placeholder="Buscar por rut" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="col col-8">
            <p class="text-center" style="font-size: x-large">Gestión de Usuarios</p>
        </div>
        <div class="col col-2">
            <a class="btn btn-success btn-block" href={{ route('usuario.create') }}> <i class="fas fa-plus"></i> Usuario</a>
        </div>
    </div>
    <table class="table table-dark">
        <thead>
            <tr>
                <th style="width: 10%" scope="col">Rut</th>
                <th style="width: 25%" scope="col">Nombre</th>
                <th style="width: 25%" scope="col">Email</th>
                <th style="width: 20%" scope="col">Rol</th>
                <th style="width: 20%" scope="col" colspan="3">Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
            <tr>
                <th scope="row">{{$usuario->rut}}</th>
                <td>{{$usuario->name}}</td>
                <td>{{$usuario->email}}</td>
                <td>{{$usuario->rol}}</td>
                <td><a class="btn btn-info" href={{ route('usuario.edit', [$usuario]) }}>Editar</a></td>
                @if ($usuario->status === 1)
                     @if($usuario->rol =='Jefe Carrera')
                        <td><a class="btn btn-warning" href={{ route('changeStatus', ['id' => $usuario]) }}>Deshabilitar</a></td>
                    @endif

                    @if($usuario->rol =='Alumno')
                        <td><a class="btn btn-warning" href={{ route('changeStatus', ['id' => $usuario]) }}>Deshabilitar</a></td>
                    @endif
                @else
                    <td><a class="btn btn-info" href={{ route('changeStatus', ['id' => $usuario]) }}>Habilitar</a></td>
                @endif

                <td>
                    <form action='/reset-password/{{$usuario->id}}'
                        method="POST">
                        @csrf<button class="btn-info">Reiniciar Clave</button>
                    </form>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if ($usuarios->links())
        <div class="d-flex justify-content-center">
            {!! $usuarios->links() !!}
        </div>
    @endif

</div>

@else
@php
header("Location: /home" );
exit();
@endphp
@endif


@endsection
