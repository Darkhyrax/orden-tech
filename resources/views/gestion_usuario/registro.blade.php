@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Crear nuevo usuario') }}</div>

                <div class="card-body">
                    <form id="registro_user">
                        @csrf

                        <div class="row">
                            <p>Campos con <span class="required">*</span> son obligatorios</p>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"><span class="required">*</span> {{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"  autocomplete="name" required autofocus>

                                <span class="text-danger">
                                    <strong id="name-error"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right"><span class="required">*</span> {{ __('Apellido') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" autocomplete="last_name" autofocus>

                                <span class="text-danger">
                                    <strong id="last_name-error"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"><span class="required">*</span> {{ __('Correo Electronico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email">

                                <span class="text-danger">
                                    <strong id="email-error"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><span class="required">*</span> {{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">

                                <span class="text-danger">
                                    <strong id="password-error"></strong>
                                </span>
                                <p><strong>Minimo 8 caracteres</strong></p>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                <br>
                                <a href="{{route('login')}}">Ya tengo usuario</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    @section('js')
        <script src="{{ asset('js/registro_form.js') }}" defer></script>
    @endsection
@endsection
