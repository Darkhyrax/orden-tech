$(document).ready(function ()
{

	$(document).on('click','#btnadd',function(e)
    {
	    $.ajax({
	          url: '/orders/agregar_producto',
	          data:$("#order_form").serialize(),
	          dataType:'JSON',
	          type:'post',
	          success: function(resp)
	          {
	          	 // Elimina el mensaje de error de los campos que estan correctos
         		 $("#order_form").find("strong[id]").text('');
				 $("#order_form").find('input:text, input:password, input:file, input[name="email"],select, textarea').removeClass('is-invalid');
	          	 
	          	 var col_nombre = '<td>'+resp.nombre+'<input type="hidden" value="'+resp.id+'" name="articulos[]"></td>';
	          	 var col_precio = '<td><span id="precio_articulo_'+resp.id+'">'+resp.precio+'</span></td>';
	          	 var col_cantidad = '<td><input style="width:25%;" type="number" min="1" class="form-control cantidad" value="1" name="cantidad[]" articulo="'+resp.id+'"></td>';
	          	 var col_total = '<td class="subtotal"><span id="total_articulo_'+resp.id+'">'+resp.precio+'</span></td>';
	          	 var col_accion = '<td><button class="btn btn-danger btn-xs remover_articulo" articulo="'+resp.id+'">Eliminar</button></td>';
				 var row = '<tr id="articulo_'+resp.id+'">'+col_nombre+col_precio+col_cantidad+col_total+col_accion+'</tr>';
				 $('#order_details_table').find('tbody').append(row);

				 $('#articulo option[value="'+resp.id+'"]').hide();
				 $("#articulo").val('');

				 total_orden();
	          },
	          error: function(xhr, ajaxOptions, thrownError) 
	          {  
	          	  // Error de formulario validacion
	              if (xhr.status == 422) 
	              {
	              	 // Estilo de bootstrap para marcar que estan correctos los datos
	              	 $("#order_form").find('input:text, input:password, input:file, input[name="email"],select, textarea').removeClass('is-invalid').addClass('is-valid');

	              	 // Definido en el archivo general.js, muestra los campos que contienen errores en el formulario
	              	 errores_formulario(xhr.responseJSON.errors);
	              	 
	              	 mensajes_web('error','Por favor valide los campos seleccionados');
	              }
	              else
	              {
	              	 mensajes_web('error','');
	              }                   
	          }
	         
	        });
    });

    $(document).on('click','.remover_articulo',function(e)
    {
    	$('#articulo_'+$(this).attr('articulo')).remove();
    	$('#articulo option[value="'+$(this).attr('articulo')+'"]').show();
	 	$("#articulo").val('');

	 	total_orden();
    });

    $(document).on('keyup mouseup', '.cantidad', function() 
    {                                                                                                                     
	  	if ($(this).val() == 0) 
	  	{
	  		$(this).val(1);
	  	}
	  	else
	  	{
	  		var precio_unitario = parseInt($('#precio_articulo_'+$(this).attr('articulo')).text());
	  		var total = parseInt(precio_unitario * $(this).val());
	  		$("#total_articulo_"+$(this).attr('articulo')).text(total);

	  		total_orden();
	  	}
	});

});


function total_orden() 
{
	var total_orden = 0;

	$.each($("#order_details_table").find('.subtotal'), function(key,value)
 	{
	 	var total_articulo = parseInt($(this).find('span').text());
	 	total_orden = parseInt(total_orden + total_articulo);
 	});

 	$("#total_order").text(total_orden);
 	$("#hidden_total").val(total_orden);
}