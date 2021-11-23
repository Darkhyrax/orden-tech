$(document).ready(function ()
{
	$(document).on('click','.btn',function(e)
    {
    	  var url = 'http://localhost:8000/api/guardar'
        e.preventDefault();

        $.ajax({
          url: url,
          data:$("#registro_user").serialize(),
          dataType:'JSON',
          type:'post',
          success: function(resp)
          {
          	 // Definido en el archivo general.js, muestra alerta de mensajes (error 500 o otros)
      			 mensajes_web('success','Se ha creado el usuario exitosamente, redirigiendo a inicio de sesión...');
  				
  				  setTimeout(function(){ location.href = 'login'; }, 3000);
          },
          error: function(xhr, ajaxOptions, thrownError) 
          {  
          	  // Error de formulario validacion
              if (xhr.status == 422) 
              {
                 // Elimina el mensaje de error de los campos que estan correctos
                 $("#registro_user").find("strong[id]").text('');
              	 // Estilo de bootstrap para marcar que estan correctos los datos
              	 $("#registro_user").find('input:text, input:password, input:file, input[name="email"],select, textarea').removeClass('is-invalid').addClass('is-valid');

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
});