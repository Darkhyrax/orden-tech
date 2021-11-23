$(document).ready(function ()
{
	$(document).on('click','.btn',function(e)
    {
    	  var url = 'http://localhost:8000/api/iniciar_sesion'
        e.preventDefault();

        $.ajax({
          url: url,
          data:$("#login_form").serialize(),
          dataType:'JSON',
          type:'post',
          success: function(resp)
          {  				
  				    location.href = '/sesion/'+resp.user_id;
          },
          error: function(xhr, ajaxOptions, thrownError) 
          {  
          	  // Error de formulario validacion
              if (xhr.status == 422) 
              {
                  // Elimina el mensaje de error de los campos que estan correctos
                  $("#login_form").find("strong[id]").text('');
                  // Estilo de bootstrap para marcar que estan correctos los datos
                  $("#login_form").find('input:text, input:password, input:file, input[name="email"],select, textarea').removeClass('is-invalid').addClass('is-valid');
              	 // Definido en el archivo general.js, muestra los campos que contienen errores en el formulario
              	 errores_formulario(xhr.responseJSON.errors);

              	 mensajes_web('error','Por favor valide los campos seleccionados');
              }
              else
              {
                 let mensaje = xhr.responseJSON.error;
              	 mensajes_web('error',mensaje);
              }                   
          }
         
        });

    });
});