@extends('layouts.app')

@section('css')

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Editar orden</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <strong>Oops!</strong> Por favor corrija los siguientes errores. 
                              <br>
                              @foreach ($errors->all() as $error)
                                 <p>{{$error}}</p>
                              @endforeach
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                        </div>
                     
                    @endif
                    <h4>Editando orden <strong>#{{$order->numero_orden}}</strong></h4>
                    <form id="order_form" method="POST" action="{{ route('orders.update',$order->id) }}">
                        @csrf
                         <div class="row">
                            <p>Campos con <span class="required">*</span> son obligatorios</p>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-5">
                                  <label for="estatus"><span class="required">*</span> Estatus</label>
                                  <select name="estatus" id="estatus" class="form-control" autofocus>
                                    <option value=''>Seleccione un estatus</option>
                                    @foreach ($estados as $estado)
                                        <option value="{{$estado->id}}" @if($order->estado_id == $estado->id) selected @endif>{{$estado->estado}}</option>
                                    @endforeach
                                  </select>
                                  @error('estado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                            </div>

                            <div class="form-group col-md-5">
                                  <label for="articulo"><span class="required">*</span> Articulo</label>
                                  <select name="articulo" id="articulo" class="form-control" autofocus>
                                    <option selected value=''>Seleccione un articulo</option>
                                    @foreach ($articulos as $articulo)
                                        <option value="{{$articulo->id}}">{{$articulo->nombre}} ({{$articulo->precio}}$)</option>
                                    @endforeach
                                  </select>
                                  <span class="text-danger">
                                    <strong id="articulo-error"></strong>
                                  </span>
                            </div>
                            <div class="form-group col-md-2 mt-4">
                                <button class="btn btn-primary" id="btnadd" type="button">Añadir a la lista</button>
                            </div>
                        </div>
                            <table class="table table-striped table-hover" id="order_details_table">
                                <thead>
                                    <tr>
                                        <th>
                                            Articulo
                                        </th>
                                        <th>
                                            Costo Unitario
                                        </th>
                                        <th>
                                            Cantidad
                                        </th>
                                        <th>
                                            SubTotal
                                        </th>
                                        <th>
                                            
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($articulos_comprados as $articulo_comprado)
                                        <tr id="articulo_{{$articulo_comprado->articulo_id}}">
                                            <td>
                                                {{$articulo_comprado->articulo->nombre}}
                                                <input type="hidden" value="{{$articulo_comprado->articulo_id}}" name="articulos[]">
                                            </td>
                                            <td>
                                                <span id="precio_articulo_{{$articulo_comprado->articulo_id}}">{{$articulo_comprado->precio}}</span>  
                                            </td>
                                            <td>
                                                <input style="width:25%;" type="number" min="1" class="form-control cantidad" value="{{$articulo_comprado->cantidad}}" name="cantidad[]" articulo="{{$articulo_comprado->articulo_id}}"> 
                                            </td>
                                            <td class="subtotal">
                                                <span id="total_articulo_{{$articulo_comprado->articulo_id}}">{{$articulo_comprado->total}}</span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-xs remover_articulo" articulo="{{$articulo_comprado->articulo_id}}">Eliminar</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        <div class="form-group row mb-0">
                            <div class="col-md-12" align="center">
                                <strong>Total orden:</strong> <span id="total_order">{{$order->monto}}</span>$
                                <input type="hidden" id="hidden_total" name="monto" value="{{$order->monto}}">
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-md-12" align="center">
                                <button type="submit" class="btn btn-success">
                                    Editar orden
                                </button>
                                <a href="{{route('orders.index')}}" class="btn btn-danger">Volver</a>
                            </div>
                        </div>     
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('js/order_form.js') }}" defer></script>
@endsection

