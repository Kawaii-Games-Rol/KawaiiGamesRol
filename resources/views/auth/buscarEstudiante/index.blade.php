@extends('layouts.app')

@section('content')

    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <i class="fas fa-users"></i>
                </div>
                <div class="col-lg-12 login-title">
                    BUSCAR ESTUDIANTE
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form id="formulario"
                            method="POST"
                            action="{{ route('postBuscarEstudiante') }}">
                            @csrf
                            <div class="form-group">
                                <label class="form-control-label">RUT</label>
                                <input id="rut"
                                    type="text"
                                    class="form-control @error('rut') is-invalid @enderror"
                                    name="rut"
                                    value="{{ old('rut') }}"
                                    required
                                    autocomplete="rut"
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
                                        class="btn btn-outline-primary">{{ __('Buscar') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
    @endsection
