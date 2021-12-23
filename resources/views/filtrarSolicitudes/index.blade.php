@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-2"></div>
        <div class="col-lg-6 col-md-8 login-box">
            <div class="col-lg-12 login-key">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="col-lg-12 login-title">
                FILTRAR SOLICITUDES
            </div>
            <div class="col-lg-12 login-form">
                <div class="col-lg-12 login-form">
                    <form id="formulario" method="POST" action="{{ route('postfiltrarSolicitud') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="user" id="user" value={{Auth::user()->id}} hidden>
                        <div class="form-group">
                            <label for="form-control-label" style="color: black">Filtrar por</label>
                            <select class="form-control" name="tipo" id="tipo">
                                <option value={{ null }}>Seleccione..</option>
                                <option value="1" @if (old('tipo')=="1" ) selected @endif>Numero de solicitud
                                </option>
                                <option value="2" @if (old('tipo')=="2" ) selected @endif>Tipo de solicitud
                                </option>
                            </select>
                        </div>
                        <br>
                        <div class="form-group" id="groupNumero" hidden>
                            <label class="form-control-label">NUMERO SOLICITUD</label>
                            <input id="numero" type="text"
                                class="form-control @error('numero') is-invalid @enderror" name="numero"
                                value="{{ old('numero') }}" autocomplete="numero" autofocus>

                            @error('numero')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group" id="groupTipoSolicitud" hidden>
                            <label for="form-control-label" style="color: black">TIPO DE SOLICITUD</label>
                            <select class="form-control" name="solicitud" id="solicitud">
                                <option value={{ null }}>Seleccione..</option>
                                <option value="1" @if (old('solicitud')=="1" ) selected @endif>Solicitud de Sobrecupo
                                </option>
                                <option value="2" @if (old('solicitud')=="2" ) selected @endif>Solicitud Cambio de Paralelo
                                </option>
                                <option value="3" @if (old('solicitud')=="3" ) selected @endif>Solicitud Eliminación de
                                    Asignatura</option>
                                <option value="4" @if (old('solicitud')=="4" ) selected @endif>Solicitud Inscripción de
                                    Asignatura</option>
                                <option value="5" @if (old('solicitud')=="5" ) selected @endif>Solicitud Ayudantía</option>
                                <option value="6" @if (old('solicitud')=="6" ) selected @endif>Solicitud Facilidades
                                    Académicas</option>
                            </select>
                        </div>
                

                        <div hidden id="groupButton" class="col-lg-12 py-3">
                        <form id="formulario"
                            method="POST"
                            action="{{ route('postfiltrarSolicitud') }}">
                            @csrf
                            <div class="form-group">
                                <label class="form-control-label">  </label>
                                <input id="Hola"
                                    type="text"
                                    class="form-control @error('Hola') is-invalid @enderror"
                                    name="Hola"
                                    value="{{ old('numero') }}"
                                    required
                                
                                    autofocus>

                                @error('rut')
                                    <span class="invalid-feedback"
                                        role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12 py-3">
                                <div class="col-lg-12 text-center">
                                    <button id="boton"
                                        class="btn btn-outline-primary">{{ __('Filtrar') }}</button>
                                </div>
                            </div>
                        </form>

                        <div hidden id="groupButton2" class="col-lg-12 py-3">
                            <div class="col-lg-12 text-center">
                                <button id="boton"
                                    class="btn btn-outline-primary">{{ __('Buscar') }}</button>
                            </div>
                        </div>

                        <div hidden id="groupButton3" class="col-lg-12 py-3">
                            <div class="col-lg-12 text-center">
                                <button id="boton"
                                    class="btn btn-outline-primary">{{ __('Buscar') }}</button>
                            </div>
                        </div>

                        <div hidden id="groupButton4" class="col-lg-12 py-3">
                            <div class="col-lg-12 text-center">
                                <button id="boton"
                                    class="btn btn-outline-primary">{{ __('Buscar') }}</button>
                            </div>
                        </div>

                        <div hidden id="groupButton5" class="col-lg-12 py-3">
                            <div class="col-lg-12 text-center">
                                <button id="boton"
                                    class="btn btn-outline-primary">{{ __('Buscar') }}</button>
                            </div>
                        </div>

                        <div hidden id="groupButton6" class="col-lg-12 py-3">
                            <div class="col-lg-12 text-center">
                                <button id="boton"
                                    class="btn btn-outline-primary">{{ __('Buscar') }}</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-2"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    const selectFiltro = document.getElementById('tipo');
    const selectTipo =document.getElementById('solicitud');
    const inputTipoSolicitud = document.getElementById('groupTipoSolicitud');
    const inputNumero = document.getElementById('groupNumero');


    const button = document.getElementById('groupButton');
    const button2 = document.getElementById('groupButton2');
    const button3 = document.getElementById('groupButton3');
    const button4 = document.getElementById('groupButton4');
    const button5 = document.getElementById('groupButton5');
    const button6 = document.getElementById('groupButton6');


    switch ({!! json_encode(old('tipo')) !!}) {
            case "1":
                inputTipoSolicitud.hidden = true;
                inputNumero.hidden=false;
                button.hidden = false;

                button2.hidden = true;
                button3.hidden=true;
                button4.hidden=true;
                button5.hidden=true;
                button6.hidden=true;
                break;
            case "2":
                inputTipoSolicitud.hidden = false;
                inputNumero.hidden=true;
                button.hidden = true;
                break;
            default:
            inputTipoSolicitud.hidden = true;
                inputNumero.hidden=true;
                button.hidden = true;
                button2.hidden = true;
                button3.hidden=true;
                button4.hidden=true;
                button5.hidden=true;
                button6.hidden=true;
                break;
        }



    selectFiltro.addEventListener('change', () => {
        switch (selectFiltro.value) {
            case "1":
                inputTipoSolicitud.hidden = true;
                inputNumero.hidden=false;
                button.hidden = false;

                button2.hidden = true;
                button3.hidden=true;
                button4.hidden=true;
                button5.hidden=true;
                button6.hidden=true;
                break;
            case "2":
                inputTipoSolicitud.hidden = false;
                inputNumero.hidden=true;
                button.hidden = true;
                break;
            default:
            inputTipoSolicitud.hidden = true;
                inputNumero.hidden=true;
                button.hidden = true;
                button2.hidden = true;
                button3.hidden=true;
                button4.hidden=true;
                button5.hidden=true;
                button6.hidden=true;
                break;
        }
    })


    switch ({!! json_encode(old('solicitud')) !!}) {
            case "1":

                button.hidden=true;
                button2.hidden = false;
                button3.hidden=true;
                button4.hidden=true;
                button5.hidden=true;
                button6.hidden=true;

                break;
            case "2":

                button.hidden=true;
                button2.hidden = true;
                button3.hidden=false;
                button4.hidden=true;
                button5.hidden=true;
                button6.hidden=true;

            case "3":

                button.hidden=true;
                button2.hidden = true;
                button3.hidden=true;
                button4.hidden=false;
                button5.hidden=true;
                button6.hidden=true;

                break;
            case "4":

                button.hidden=true;
                button2.hidden = true;
                button3.hidden=true;
                button4.hidden=true;
                button5.hidden=false;
                button6.hidden=true;

                break;
            case "5":

                button.hidden=true;
                button2.hidden = true;
                button3.hidden=true;
                button4.hidden=true;
                button5.hidden=true;
                button6.hidden=false;

                break;

            default:

                button.hidden=true;
                button2.hidden = true;
                button3.hidden=true;
                button4.hidden=true;
                button5.hidden=true;
                button6.hidden=true;
                break;
        }
    selectTipo.addEventListener('change', () => {
        switch (selectTipo.value) {
            case "1":

                button.hidden=true;
                button2.hidden = false;
                button3.hidden=true;
                button4.hidden=true;
                button5.hidden=true;
                button6.hidden=true;

                break;
            case "2":

                button.hidden=true;
                button2.hidden = true;
                button3.hidden=false;
                button4.hidden=true;
                button5.hidden=true;
                button6.hidden=true;

            case "3":

                button.hidden=true;
                button2.hidden = true;
                button3.hidden=true;
                button4.hidden=false;
                button5.hidden=true;
                button6.hidden=true;

                break;
            case "4":

                button.hidden=true;
                button2.hidden = true;
                button3.hidden=true;
                button4.hidden=true;
                button5.hidden=false;
                button6.hidden=true;

                break;
            case "5":

                button.hidden=true;
                button2.hidden = true;
                button3.hidden=true;
                button4.hidden=true;
                button5.hidden=true;
                button6.hidden=false;

                break;

            default:

                button.hidden=true;
                button2.hidden = true;
                button3.hidden=true;
                button4.hidden=true;
                button5.hidden=true;
                button6.hidden=true;
                break;
        }
    })

</script>
@endsection
