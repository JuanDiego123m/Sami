/*=============================================
BOTON EDITAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEditarCliente", function(){

  var idCliente = $(this).attr("idCliente");

  window.location = "index.php?ruta=editar-cliente&idCliente="+idCliente;


})

/*========================================
=         BOTÓN ELIMINAR CLIENTE            =
========================================*/
$(document).on("click", ".btnEliminarCliente", function(){
  var idCliente = $(this).attr("id")
  swal({

    title: "¿Quieres borrar el cliente?",
    text: "¡Pulsa en cancelar si no quieres hacerlo!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3CB9F7',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Borrar',

  }).then((result)=>{


    if (result.value){

      window.location = "index.php?ruta=clientes&id="+idCliente;
    }
  })

})

