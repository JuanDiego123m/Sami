/*=============================================
BOTON EDITAR EMPLEADO
=============================================*/
$(".tablas").on("click", ".btnEditarEmpleado", function(){

    var idItem = $(this).attr("idEmpleado");
  
    window.location = "index.php?ruta=editar-empleados&idItem="+idItem;

  
  
  })

  /*=======================================
=            ACTIVAR EMPLEADO            =
=======================================*/
$(document).on("click", ".btnActivarE", function(){

	var id = $(this).attr("idEmpleado");
	var estadoEmpleado = $(this).attr("estadoEmpleado");

	var datos = new FormData();
	datos.append("activarId", id);
	datos.append("activarEmpleado", estadoEmpleado);

	$.ajax({

		url:"ajax/empleados.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){

			if(window.matchMedia("(max-width:767px)").matches){

				swal({

					title: "¡Hecho!",
					type: "success",
					confirmButtonText: "Cerrar",

				}).then(function(result){
					if (result.value){
						window.location = "empleados";
					}
				});

			}

		}

	})

	if(estadoEmpleado == 0){

  		$(this).removeClass('btn-cr');
  		$(this).addClass('btn-danger');
  		$(this).html('Deshabilitado');
  		$(this).attr('estadoEmpleado',1);

  	}else{

  		$(this).addClass('btn-cr');
  		$(this).removeClass('btn-danger');
  		$(this).html('Habilitado');
  		$(this).attr('estadoEmpleado',0);

  	}

})
  
  /*========================================
  =            ELIMINAR EMPLEADO            =
  ========================================*/
  $(document).on("click", ".btnEliminarEmpleados", function(){
	var idEmpleado = $(this).attr("idEmplea")
	swal({
  
	  title: "¿Quieres borrar este empleado?",
	  text: "¡Pulsa en cancelar si no quieres hacerlo!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3CB9F7',
	  cancelButtonColor: '#d33',
	  cancelButtonText: 'Cancelar',
	  confirmButtonText: 'Borrar',
  
	}).then((result)=>{
  
  
	  if (result.value){
  
		window.location = "index.php?ruta=empleados&idEmplea="+idEmpleado;
	  }
	})
  
  })
