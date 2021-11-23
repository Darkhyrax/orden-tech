<h3>Articulos orden #{{$numero_orden}}</h3>

<div class="mt-4">
	<table class="table table-dark table-striped table-hover" id="details-table">
		<thead>
			<tr>
				<th scope="col">
					Articulo
			    </th>
			    <th scope="col">
			    	Precio
			    </th>
			    <th scope="col">
			    	Cantidad
			    </th>
			    <th scope="col">
			    	Total
			    </th>
			</tr>
		</thead>
		<tbody>
			@foreach ($articulos_comprados as $articulo)
				<tr>
					<td>
						{{$articulo->articulo->nombre}}
					</td>
					<td>
						{{$articulo->precio}}
					</td>
					<td>
						{{$articulo->cantidad}}
					</td>
					<td>
						{{$articulo->total}}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="mt-2" align="center">
	 <button type="button" class="btn btn-info text-white" data-dismiss="modal" aria-label="Close">
        Aceptar
    </button>
</div>

<script>
	$('#details-table').DataTable({
    	language: {
    		url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
    	}
    });
</script>