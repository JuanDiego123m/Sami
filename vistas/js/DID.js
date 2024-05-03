/*=============================================
BOTON EDITAR DID
=============================================*/
$(".tablas").on("click", ".btnEditarDID", function(){

    var idDid = $(this).attr("idDID");
  
    window.location = "index.php?ruta=editar-DID&idDID="+idDid;
  
  
  })
  
  /*========================================
  =           BOTÓN ELIMINAR DID            =
  ========================================*/

  $(document).on("click", ".btnEliminarDID", function(){
  
    var id = $(this).attr("idD");


    // id = id.trim();

// Eliminar los espacios en blanco dentro de la cadena usando replace()
// id = id.replace(/\s+/g, '');

  swal({
  
      title: 'Borrar DID',
      text: "Se borrarán todos los datos",
      type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Borrar'
          }).then(function(result){
          if (result.value) {
  
            window.location = "index.php?ruta=DID&idD="+id;
            
  
          }

  
    })
  
  })



    /*========================================
  =    PLUGGIN BUSCADOR EN EL SELECT        =
  ========================================*/
  $(document).ready(function() {
    $(".select_buscador_modal").select2({
      dropdownParent: $("#modalAgregarDID")
    });
  });