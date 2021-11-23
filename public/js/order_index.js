$(document).ready( function () {
    $('#orders-table').DataTable({
    	language: {
    		url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
    	}
    });

    $(document).on('click','#btndetails',function(e)
    {
        let url = $(this).attr('data-attr');
        e.preventDefault();

        $.ajax({
          url: url,
          success: function(resp)
          {
              $("#detail_order").html(resp);
              $("#modal_details_order").modal("show"); 
          },
          error: function(xhr, ajaxOptions, thrownError) 
          {
                // Definido en el archivo general.js, muestra alerta de mensajes (error 500 o otros)
                mensajes_web('error','');              
          }
         
        });
    });
} );