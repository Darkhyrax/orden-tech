@extends('layouts.app')

@section('css')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Listado de usuarios API</div>
                <div class="card-body">
                	<table class="table table-dark table-striped table-hover" id="users-table">
				  	  <thead>
					    <tr>
					    	<th scope="col">
					    		Nombre
						    </th>
						    <th scope="col">
						    	Apellido
						    </th>
						    <th scope="col">
						    	Email
						    </th>
						    <th scope="col">
						    	Fecha registro
						    </th>
						    <th scope="col">
						    	Ultima Modificación
						    </th>
					    </tr>
					  </thead>
					</table>
            	</div>
        	</div>
    	</div>
	</div>
</div>
@endsection

@section('js')
    	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.min.js"></script>
        <script>
        	$(document).ready(function() {
			    $('#users-table').DataTable( {
			        "ajax": { url: "{{route('api.users')}}",
		        				dataSrc:'',
			    			},
			       "columns": [
			            { "data": "name" },
			            { "data": "last_name" },
			            { "data": "email" },
			            { "data": "created_at"},
			            { "data": "updated_at" },
			        ],
			        'columnDefs': [ {
				      targets: [3,4],
				      render: function ( data, type, row, meta ) 
				      {
					      return $.format.date(data, "dd/MM/yyyy hh:mm:ssp");
					    }
				    } ]
			    } );
			} );
        </script>
@endsection