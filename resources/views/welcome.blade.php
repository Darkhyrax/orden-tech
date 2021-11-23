@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Bienvenido</div>
                <div class="card-body">
                    <div align="center">
                        @guest
                            <h3>Hola, para comenzar debe iniciar sesión</h3>
                            <a href="{{route('login')}}" class="btn btn-info text-white">Iniciar Sesión</a>
                        @else
                            <h3>Bienvenido, {{\Auth::user()->email}}</h3>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection