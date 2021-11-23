@extends('layouts.app')

@section('css')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Listado de ordenes</div>
                <div class="card-body">
                	<a href="{{ route('orders.create') }}" class="btn btn-success mb-4">Registrar orden</a>
                	<table class="table table-dark table-striped table-hover" id="orders-table">
				  	  <thead>
					    <tr>
					    	<th scope="col">
					    		Numero de orden
						    </th>
						    <th scope="col">
						    	Fecha registro
						    </th>
						    <th scope="col">
						    	Monto
						    </th>
						    <th scope="col">
						    	Estatus
						    </th>
						    <th scope="col">
						    	Pedido realizado por
						    </th>
						    <th scope="col">
						    	Ultima Modificacion
						    </th>
						    <th scope="col">
						    	Acciones
						    </th>
					    </tr>
					  </thead>
					  <tbody>
					  	@foreach ($orders as $order)
					  		<tr>
					  			<td>
					  				{{$order->numero_orden}}
					  			</td>
					  			<td>
					  				{{date('d-m-Y h:ia',strtotime($order->created_at))}}
					  			</td>
					  			<td>
					  				{{number_format($order->monto,2)}}$
					  			</td>
					  			<td>
					  				{{$order->estado->estado}}
					  			</td>
					  			<td>
					  				{{$order->user->name}} {{$order->user->last_name}}
					  			</td>
					  			<td>
					  				{{date('d-m-Y h:ia',strtotime($order->updated_at))}}
					  			</td>
					  			<td>
					  				<button class="btn btn-info btn-sm text-white" data-toggle="modal" data-attr="{{ route('orders.show', $order->id) }}" id="btndetails">Ver</button>
					  				<a href="{{route('orders.edit',$order->id)}}" class="btn btn-info btn-sm text-white">Editar</a>
					  				<form action="{{route('orders.destroy',$order->id)}}" method="post">
					  					@csrf
					  					{{method_field('DELETE')}}
					  					<button class="btn btn-danger btn-sm" onclick="confirm('¿Está seguro de eliminar esta orden?')">Eliminar</button>
					  					
					  				</form>
					  			</td>
					  		</tr>
					  	@endforeach
					  </tbody>
					</table>
            	</div>
        	</div>
    	</div>
	</div>
</div>

<!-- modal -->
    <div class="modal fade" id="modal_details_order" tabindex="-1" role="dialog" aria-labelledby="orderdetailslabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                	<h3>Detalles de orden</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="detail_order"></div>
                </div>
            </div>
        </div>
    </div>
<!-- //modal -->
@endsection

@section('js')
    	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" defer></script>
    	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js" defer></script>
        <script src="{{ asset('js/order_index.js') }}" defer></script>
@endsection