@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-2"></div>
        <div class="col-lg-6 col-md-6 login-box">
            <div class="login-title">REGISTRO DE ALUMNO</div>
            <div class="row">
                <div class="col-6">
                    <div class="row-12">
                        <div class="col-lg-12 login-key">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                    <div class="row-12">
                        <div class="col-lg-12 mt-4 text-light login-title" style="font-size: 15px">
                            Nombre:
                            {{ $user->name }}
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <table class="table table-striped table-hover  table-hover table-sm" style="background-color:#DBE2E9">
                        <tbody>
                            <tr>
                                <td>Rut:</td>
                                <td>{{ $user->rut }}</td>
                            </tr>
                            <tr>
                                <td>Nombre:</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td>Carrera:</td>
                                <td>{{ $user->carrera()->first()->nombre }}</td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-3 col-md-2"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-2"></div>
        <div class="col-lg-6 col-md-6 mt-3 login-box">
            <div class="col-12">
                <div class="login-title">SOLICITUDES</div>
                <table class="table table-striped table-hover table-hover table-sm" style="background-color:#DBE2E9">
                    <thead>
                        <th scope="col">id</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Ver</th>
         
            </div>
        </div>
        <div class="col-lg-3 col-md-2"></div>
    </div>

@endsection
