@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-2"></div>
        <div class="col-lg-6 col-md-6 login-box">

            <div class="login-title">Solicitud Nº {{$solicitud->getOriginal()['pivot_id']}}</div>
            <div class="row">
                <div class="col-6">
                    <div class="row-12">
                        <div class="col-lg-12 login-key">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>

                    </div>
                </div>
                <div class="row-12">
                    <table class="table table-striped table-hover table-hover table-sm" style="background-color:#DBE2E9">
                        <tbody>
                            <tr>
                                <td>Fecha de la solicitud:</td>
                                   
                                <td>{{ $solicitud->getOriginal()['pivot_updated_at'] }}</td>
                            </tr>
                            <tr>
                                <td>Numero de la solicitud:</td>
                                <td>{{ $solicitud->getOriginal()['pivot_id'] }}</td>
                            </tr>
                            <tr>
                                <td>Rut del estudiante:</td>
                                <td>{{ $user->rut }}</td>
                            </tr>
                            <tr>
                                <td>Nombre del estudiante:</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td>Tipo de solicitud:</td>
                                <td>{{ $solicitud->getOriginal()['tipo'] }}</td>
                            </tr>
                            <tr>
                                <td>Email del estudiante:</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>Numero de telefono del estudiante:</td>
                                <td>{{ $solicitud->getOriginal()['pivot_telefono'] }}</td>
                            </tr>



                            @if ($solicitud->getOriginal()['pivot_NRC'])
                            <tr>


                            </tr>
                            <tr>
                                <td>NRC:</td>
                                <td>{{ $solicitud->getOriginal()['pivot_NRC'] }}</td>
                            </tr>
                            <tr>

                            </tr>
                            @endif

                            @if ($solicitud->getOriginal()['pivot_nombre_asignatura'])
                            <tr>


                            </tr>
                            <tr>
                                <td>Nombre de la asignatura:</td>
                                <td>{{ $solicitud->getOriginal()['pivot_nombre_asignatura'] }}</td>
                            </tr>
                            <tr>

                            </tr>
                            @endif

                            @if ($solicitud->getOriginal()['pivot_detalles'])
                            <tr>


                            </tr>
                            <tr>
                                <td>Detalles de la solicitud:</td>
                                <td>{{$solicitud->getOriginal()['pivot_detalles'] }}</td>
                            </tr>
                            <tr>

                            </tr>
                            @endif

                            @if ($solicitud->getOriginal()['pivot_calificacion_aprob'])
                            <tr>


                            </tr>
                            <tr>
                                <td>Calificacion de aprobacion:</td>
                                <td>{{ $solicitud->getOriginal()['pivot_calificacion_aprob'] }}</td>
                            </tr>
                            <tr>

                            </tr>
                            @endif

                            @if ($solicitud->getOriginal()['pivot_cant_ayudantias'])
                            <tr>

                            </tr>
                            <tr>
                                <td>Cantidad de ayudantias:</td>
                                <td>{{ $solicitud->getOriginal()['pivot_cant_ayudantias'] }}</td>
                            </tr>
                            <tr>

                            </tr>
                            @endif

                            @if ($solicitud->getOriginal()['pivot_tipo_facilidad'])
                            <tr>


                            </tr>
                            <tr>
                                <td>Tipo de facilidad:</td>
                                <td>{{ $solicitud->getOriginal()['pivot_tipo_facilidad'] }}</td>
                            </tr>
                            <tr>

                            </tr>
                            @endif
                            @if ($solicitud->getOriginal()['pivot_nombre_profesor'])
                            <tr>


                            </tr>
                            <tr>
                                <td>Nombre del profesor:</td>
                                <td>{{ $solicitud->getOriginal()['pivot_nombre_profesor'] }}</td>
                            </tr>
                            <tr>

                            </tr>
                            @endif


                            @if ($solicitud->getOriginal()['pivot_archivos'])
                            <tr>

                                <td>Archivos:</td>
                                <td>
                                    @foreach (json_decode($solicitud->getOriginal()['pivot_archivos']) as $file)
                                    <a href={{"/storage/docs/".$file}}>Archivo</a>
                                    @endforeach


                                </td>

                            </tr>
                            @endif
                            @if ($solicitud->pivot->estado == 1)
                            <tr>


                            </tr>
                            <tr>
                                <td>Estado:</td>
                                <td>ACEPTADA</td>
                            </tr>
                            <tr>

                            </tr>
                            @endif
                            @if ($solicitud->pivot->estado == 2)
                            <tr>


                            </tr>
                            <tr>
                                <td>Estado:</td>
                                <td>ACEPTADA CON OBSERVACIONES</td>
                            </tr>
                            <tr>

                            </tr>
                            @endif
                            @if ($solicitud->pivot->estado == 3)
                            <tr>


                            </tr>
                            <tr>
                                <td>Estado:</td>
                                <td>RECHAZADA</td>
                            </tr>
                            <tr>

                            </tr>
                            @endif
                            @if ($solicitud->pivot->estado == 4)
                            <tr>


                            </tr>
                            <tr>
                                <td>Estado:</td>
                                <td>ANULADA</td>
                            </tr>
                            <tr>

                            </tr>
                            @endif
                            @if ($solicitud->pivot->estado == 0)
                            <tr>


                            </tr>
                            <tr>
                                <td>Estado:</td>
                                <td>PENDIENTE</td>
                            </tr>
                            <tr>

                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

               

@endsection

