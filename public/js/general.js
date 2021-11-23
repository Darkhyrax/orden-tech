$(document).ready(function ()
{

});

function errores_formulario(campos) 
{
	 $.each(campos, function(campo,mensaje)
	 {
	 		$('#'+campo).removeClass('is-valid');
 			$('#'+campo).addClass('is-invalid');
 			$("#"+campo+"-error").text(mensaje);
	 });
}

function mensajes_web(tipo,mensaje) 
{

	if (mensaje == '' && tipo == "success") 
	{
		mensaje = 'Se ha procesado el registro exitosamente';
	}
	else if (mensaje == '' && tipo == 'error') 
	{
		mensaje = 'Ha ocurrido un error, por favor intente mas tarde';
	}

	toastr.options =
	{
		"closeButton" : true,
		"progressBar" : false,
		"preventDuplicates": true,
		"newestOnTop": false,
		"positionClass": "toast-bottom-right"
	}

	if (tipo == "success") 
	{
		toastr.success(mensaje);
	}
	else if (tipo == "warning") 
	{
		toastr.warning(mensaje);
	}
	else
	{
		toastr.error(mensaje);
	}
}