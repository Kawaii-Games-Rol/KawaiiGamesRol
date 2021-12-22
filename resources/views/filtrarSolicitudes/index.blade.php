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
                    <form id="formulario" method="POST" action="{{ route('filtrarSolicitudes') }}"
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
                                class="form-control @error('telefono') is-invalid @enderror" name="numero"
                                value="{{ old('numero') }}" autocomplete="numero" autofocus>

                            @error('numero')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group" id="groupTipoSolicitud" hidden>
                            <label for="form-control-label" style="color: Black">TIPO DE SOLICITUD</label>
                            <select class="form-control" name="solicitud" id="solicitud">
                                <option value={{ null }}>Seleccione..</option>
                                <option value="1" @if (old('tipo')=="1" ) selected @endif>Solicitud de Sobrecupo
                                </option>
                                <option value="2" @if (old('tipo')=="2" ) selected @endif>Solicitud Cambio de Paralelo
                                </option>
                                <option value="3" @if (old('tipo')=="3" ) selected @endif>Solicitud Eliminación de
                                    Asignatura</option>
                                <option value="4" @if (old('tipo')=="4" ) selected @endif>Solicitud Inscripción de
                                    Asignatura</option>
                                <option value="5" @if (old('tipo')=="5" ) selected @endif>Solicitud Ayudantía</option>
                                <option value="6" @if (old('tipo')=="6" ) selected @endif>Solicitud Facilidades
                                    Académicas</option>
                            </select>
                        </div>


                        <div hidden id="groupButton" class="col-lg-12 py-3">
                            <div class="col-lg-12 text-center">
                                <button type="submit" id="boton" class="btn btn-outline-primary">{{ __('Agregar')
                                    }}</button>
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
    const inputTipoSolicitud = document.getElementById('groupTipoSolicitud');
    const inputNumero = document.getElementById('groupNumero');
    const button = document.getElementById('groupButton');
    const button2 = document.getElementById("boton");
    const form = document.getElementById("formulario");





    switch ({!! json_encode(old('tipo')) !!}) {
            case "1":
                inputTipoSolicitud.hidden = true;
                inputNumero.hidden=false;
                button.hidden = false
                break;
            case "2":
                inputTipoSolicitud.hidden = false;
                inputNumero.hidden=true;
                button.hidden = false
                break;
            default:
            inputTipoSolicitud.hidden = true;
                inputNumero.hidden=true;
                button.hidden = true;
                break;
        }



    selectFiltro.addEventListener('change', () => {
        switch (selectFiltro.value) {
            case "1":
            inputTipoSolicitud.hidden = true;
                inputNumero.hidden=false;
                button.hidden = false
                break;
            case "2":
            inputTipoSolicitud.hidden = false;
                inputNumero.hidden=true;
                button.hidden = false
                break;

            default:
            inputTipoSolicitud.hidden = true;
                inputNumero.hidden=true;
                button.hidden = true;
                break;
        }
    })

</script>
@endsection
