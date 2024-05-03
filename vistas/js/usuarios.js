/*==========================================
=            SUBIR FOTO USUARIO            =
==========================================*/

$(".nuevaFoto").change(function(){

	var imagen = this.files[0];
	

	/*=============================================
	=            FORMATO IMAGEN            =
	=============================================*/
	
	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

		$(".nuevaFoto").val("");

		swal({

			title: "Ups... no podemos cargar esta imagen",
			text: "Asegurate de seleccionar una imagen en formato JPG o PNG",
			type: "error",
			confirmButtonText: "Cerrar"
		});


	}else if(imagen["size"] > 50000000){

		$(".nuevaFoto").val("");

		swal({

			title: "Ups... no podemos cargar esta imagen",
			text: "Asegurate de seleccionar una imagen de menos de 50 mb",
			type: "error",
			confirmButtonText: "Cerrar"
		});


	}else{

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load", function(event){

			var rutaImagen = event.target.result;

			$(".previsualizar").attr("src", rutaImagen);
		})
	}
	
	
	

})

/*=====  End of SUBIR FOTO USUARIO  ======*/

/*==========================================
=            EDITAR USUARIO           =
==========================================*/

$(document).on("click", ".btnEditarUsuario", function(){

	var idUsuario = $(this).attr("idUsuario");

	var datos = new FormData();
	datos.append("idUsuario", idUsuario);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#editarPerfil").html(respuesta["perfil"]);
			$("#editarPerfil").val(respuesta["perfil"]);

			$("#fotoActual").val(respuesta["foto"]);
			$("#passwordActual").val(respuesta["password"]);

			if(respuesta["foto"] != ""){

				$(".previsualizar").attr("src", respuesta["foto"]);

			}

		}	
	});
})

/*=======================================
=            ACTIVAR USUARIO            =
=======================================*/
$(document).on("click", ".btnActivar", function(){

	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");

	var datos = new FormData();
	datos.append("activarId", idUsuario);
	datos.append("activarUsuario", estadoUsuario);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
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
						window.location = "usuarios";
					}
				});

			}

		}

	})

	if(estadoUsuario == 0){

  		$(this).removeClass('btn-cr');
  		$(this).addClass('btn-danger');
  		$(this).html('Suspendido');
  		$(this).attr('estadoUsuario',1);

  	}else{

  		$(this).addClass('btn-cr');
  		$(this).removeClass('btn-danger');
  		$(this).html('Habilitado');
  		$(this).attr('estadoUsuario',0);

  	}

})

/*========================================
=            USUARIO REPETIDO            =
========================================*/

$("#nuevoUsuario").change(function(){

	$(".alert").remove();

	var usuario = $(this).val();

	var datos = new FormData();
	datos.append("validarUsuario", usuario);

	 $.ajax({
	    url:"ajax/usuarios.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoUsuario").parent().after('<div class="alert alert-warning">El usuario ya está en uso</div>');

	    		$("#nuevoUsuario").val("");

	    	}

	    }

	})
})

/*========================================
=            ELIMINAR USUARIO            =
========================================*/
$(document).on("click", ".btnEliminarUsuario", function(){


	var idUsuario = $(this).attr("idUsuario");
	var fotoUsuario = $(this).attr("fotoUsuario");
	var usuario = $(this).attr("usuario");

	swal({

		title: "¿Quieres borrar este usuario?",
		text: "¡Pulsa en cancelar si no quieres hacerlo!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3CB9F7',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Borrar',

	}).then((result)=>{


		if (result.value){

			window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
		}
	})

})






