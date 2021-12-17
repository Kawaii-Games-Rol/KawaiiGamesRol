@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row mb-3">
        <div class="col col-8">
            <p class="text-center" style="font-size: x-large">Solicitudes pendientes</p>
        </div>
        <div class="col-lg-12 mt-4 text-light login-title" style="font-size: 15px">
                           
        <div class="col col-2">
            <a class="btn btn-success btn-block" href={{ route('usuario.create') }}> <i class="fas fa-plus"></i> Usuario</a>
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
                        
            <tr>
                <th scope="row">{{$usuario->created_at}}</th>
                <td>{{$solicitud->getOriginal()['pivot_id']}}</td>
                <td>{{$usuario->rut}}</td>
                <td>{{$usuario->name}}</td>
                <td>{{$solicitud->tipo}}</td>
                <td>
                        @csrf<button class="btn-info">Detalles</button>
                    </form>
            </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                <p>Sin Solicitudes</p>
                            </td>
                        </tr>

                        @endforelse
            <tr>
                
    

            @endforeach
        </tbody>
   
</div>

@endsection