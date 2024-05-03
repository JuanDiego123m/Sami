/*=============================================
BOTON EDITAR ITEM
=============================================*/
$(".tablas").on("click", ".btnEditarInventario", function(){

  var idInventario = $(this).attr("idInventario");

  window.location = "index.php?ruta=editar-inventario&idInventario="+idInventario;



})

 /*========================================
=            ELIMINAR INVENTARIO         =
========================================*/
$(document).on("click", ".btnEliminarInventario", function(){
  var idInventario = $(this).attr("idInventa")
  swal({

    title: "¿Quieres borrar la información?",
    text: "¡Pulsa en cancelar si no quieres hacerlo!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3CB9F7',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Borrar',

  }).then((result)=>{


    if (result.value){

      window.location = "index.php?ruta=inventario&idInventa="+idInventario;
    }
  })

})

  /*=============================================
IMPRIMIR COTIZACION
=============================================*/
$(".tablas").on("click", ".btnImprimirActa", function(){

	var codigoActa = $(this).attr("codigoCotizacion");

	window.open("extensiones/tcpdf/examples/acta.php?codigo="+codigoActa, "_blank");
	

});

/*========================================
=    PLUGGIN BUSCADOR EN EL SELECT        =
========================================*/
$(document).ready(function() {
  $(".select_buscador_modal2").select2({
    dropdownParent: $("#modalAgregarInventario")
  });
});

