$(".tablas").on("click", ".btnEditarOperacion", function(){

  var id = $(this).attr("id");
  

  window.location = "index.php?ruta=editar-operaciones&id="+id;



})

/*=======================================
=            ACTIVAR OPERACION            =
=======================================*/
$(document).on("change", ".chkActivarO", function(){
    var id = $(this).attr("id");
    var estadoOperacion = $(this).attr("estadoOperacion");
    var datos = new FormData();
    datos.append("activarId", id);
    datos.append("activarOperacion", estadoOperacion);

    $.ajax({
        url:"ajax/operaciones.ajax.php",
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
                        window.location = "operaciones";
                    }
                });
            }
        }
    });

    if(estadoOperacion == 0){
        $(this).attr('estadoOperacion', 1);
    } else {
        $(this).attr('estadoOperacion', 0);
    }
});

  
  /*========================================
  =            ELIMINAR OPERACION            =
  ========================================*/
    $(document).on("click", ".btnEliminarOperacion", function(){
    var idOperaciones = $(this).attr("idOperacion")
    swal({
  
      title: "¿Quieres borrar la operacion?",
      text: "¡Pulsa en cancelar si no quieres hacerlo!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3CB9F7',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Borrar',
  
    }).then((result)=>{
  
  
      if (result.value){
  
        window.location = "index.php?ruta=operaciones&idOperacion="+idOperaciones;
      }
    })
  
  })


    /*========================================
      =            SELECT BUSCADOR             =
     ========================================*/
   $(document).ready(function() {
    $(".select_buscador_modalOperaciones").select2({
      dropdownParent: $("#modalAgregarOperaciones")
    });
  });

