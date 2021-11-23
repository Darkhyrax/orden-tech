@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Carga de archivos</div>
                <div class="card-body">
                    <div align="center">
                        <form action="{{route('carga_archivo.carga')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                      <strong>Oops!</strong> Por favor corrija los siguientes errores: 
                                      <br>
                                      @foreach ($errors->all() as $error)
                                         <p>{{$error}}</p>
                                      @endforeach
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>
                            @endif
                            <div class="row">
                                <p>Campos con <span class="required">*</span> son obligatorios</p>
                            </div>
                            <div class="row">
                                <strong>Nota: solo archivos PDF</strong>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><span class="required">*</span> Archivos</label>

                                <div class="col-md-4">
                                    <input type="file" name="files[]" multiple />
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">Cargar archivos</button>
                        </form>

                        @if($archivos)
                            <div class="mt-5">
                                <h4>Lista de archivos cargados</h4>
                                    @foreach ($archivos as $archivo)
                                         <p><a href="{{public_path()}}/files/{{$archivo}}" target="_blank">{{$archivo}}</a></p>
                                    @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection