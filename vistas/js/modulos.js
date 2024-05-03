// /*=============================================
// EDITAR CLIENTE
// =============================================*/
// $(".tablas").on("click", ".btnEditarCliente", function(){

// 	var idCliente = $(this).attr("idCliente");

// 	var datos = new FormData();
//     datos.append("idCliente", idCliente);

//     $.ajax({

//       url:"ajax/clientes.ajax.php",
//       method: "POST",
//       data: datos,
//       cache: false,
//       contentType: false,
//       processData: false,
//       dataType:"json",
//       success:function(respuesta){
      
//       	   $("#idCliente").val(respuesta["id"]);
// 	       $("#editarCliente").val(respuesta["nombre"]);
// 	       $("#editarDocumentoId").val(respuesta["documento"]);
// 	       $("#editarEmail").val(respuesta["email"]);
// 	       $("#editarTelefono").val(respuesta["telefono"]);
// 	       $("#editarDireccion").val(respuesta["direccion"]);
//            $("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);
// 	  }

//   	})

// })

/*=============================================
BOTON EDITAR MODULO
=============================================*/
$(".tablas").on("click", ".btnEditarModulo", function(){

  var idModulo = $(this).attr("idModulo");

  window.location = "index.php?ruta=editar-modulo&idModulo="+idModulo;


})

/*========================================
=            ELIMINAR MODULO            =
========================================*/

$(".btnEliminarModulo").click(function(){

  var idModulo = $(this).attr("idModulod");

  swal({

    title: 'Borrar modulo',
    text: "Se borrarán todos los datos",
    type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Borrar'
        }).then(function(result){
        if (result.value) {

          window.location = "index.php?ruta=modulos&idModulod="+idModulo;

        }


  })


})
