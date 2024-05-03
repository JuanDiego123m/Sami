  /*========================================
  =            ELIMINAR ACTA            =
  ========================================*/

   $(document).on("click", ".btnEliminarActa", function(){
    var idActa = $(this).attr("idActa")
    swal({
  
      title: "¿Quieres borrar el acta?",
      text: "¡Pulsa en cancelar si no quieres hacerlo!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3CB9F7',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Borrar',
  
    }).then((result)=>{
  
  
      if (result.value){
  
        window.location = "index.php?ruta=acta&idActa="+idActa;
      }
    })
  
  })

  /*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/
var cuentaOculta = $("#cuentaOculta").val();

$('.tablaProductosVentas').DataTable( {
    "ajax": "ajax/datatable-ventas.ajax.php?cuentaOculta="+cuentaOculta,
    "deferRender": true,
		"retrieve": true,
		"processing": true,
		"responsive": true,
	 	"language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	},
	buttons: [
      'copy', 'excel', 'pdf'
  ]

} );

/*=============================================
AGREGAR PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

$(".tablaProductosVentas tbody").on("click", "button.agregarProducto", function(){

	var idEquipo = $(this).attr("idEquipo");

	$(this).removeClass("btn-primary agregarProducto");

	$(this).addClass("btn-table");

	var datos = new FormData();
    datos.append("idEquipo", idEquipo);

     $.ajax({

     	url:"ajax/inventario.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){

      	    var activo = respuesta["activo"];
          	var serial = respuesta["serial"];

          	if(activo != null){

      			swal({
			      title: "El activo no está disponible",
			      type: "error",
			      confirmButtonText: "Cerrar"
			    });

			    $("button[idEquipo='"+idEquipo+"']").addClass("btn-primary agregarProducto");

			    return;

          	}

          	$(".nuevoProducto").append(

          		'<!-- Descripcion -->'+

          		'<div class="mg16">'+

	          		'<div class="card-white-add-products row">'+
	                
		                '<div class="col-md-12 mg16">'+
		                    
		                    '<div class="row">'+

		                    	'<div class="col-md-1 mg16">'+
		                        
		                        	'<span class="input-group-addon"><button type="button" class="btn btn-danger quitarProducto" idProducto="'+idProducto+'"><i class="bx bx-x-circle"></i></button></span>'+

		                        '</div>'+

		                        '<div class="col-md-11 mg16">'+

		                        	'<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" id="agregarProducto" value="'+descripcion+'" required readonly>'+

		                        '</div>'+

		                    '</div>'+

		                '</div>'+

		                '<!-- Espacio -->'+

		                '<div class="col-md-6 col-xs-6 mg16">'+
		                    

		                '</div>'+

		                '<!-- Cantidad -->'+

		                '<div class="col-md-2 col-xs-2 mg16">'+

		                	'<label><strong>Cantidad</strong></label>'+
		                    
		                    '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+

		                '</div>'+

		                '<!-- Precio -->'+

		                '<div class="col-md-4 col-sx-4 ingresoPrecio mg16" id="is-relative">'+

		                	'<div class="">'+

		                		'<label><strong>Valor</strong></label>'+
		                    
			                    '<input type="text" class="form-control input nuevoPrecioNeto nuevoImpuesto nuevoValorImpuesto nuevoPrecioProducto" nuevoNeto="'+precio+'" impuestoProducto="'+impuesto_producto+'" impuestoReal="'+precio_impuesto+'" precioReal="'+total_mas_impuesto+'" name="nuevoPrecioProducto" value="'+total_mas_impuesto+'" readonly required>'+

			                '</div>'+

		                '</div>'+

		                '<!-- Detalle -->'+

		                '<div class="col-md-12 col-sx-12 ingresoDetalle mg16">'+

		                	'<div class="">'+

		                		'<label><strong>Detalle</strong></label>'+
		                    
			                    '<textarea type="text" class="form-control nuevoDetalleProducto" name="nuevoDetalleProducto" rows="3">'+detalle+'</textarea>'+

			                '</div>'+

		                '</div>'+

		            '</div>'+

		        '</div>'             

          	) 

	        // SUMAR TOTAL DE PRECIOS

	        sumarTotalPrecios()

	        // AGREGAR IMPUESTO

	        agregarImpuesto()

	        // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductos()

	        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

	        $(".nuevoPrecioProducto").number(true, 2);

      	}

     })

});

/*=============================================
QUITAR ACTIVOS DEL ACTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioActa").on("click", "button.quitarProducto", function(){

	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idItem");

	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL ACTA A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarProducto") == null){

		idQuitarProducto = [];
	
	}else{

		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

	}

	idQuitarProducto.push({"idItem":idProducto});

	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

	$("button.recuperarBoton[idItem='"+idProducto+"']").removeClass('btn-default');

	$("button.recuperarBoton[idItem='"+idProducto+"']").addClass('btn-primary agregarProducto');

	if($(".nuevoProducto").children().length == 0){

		$("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalVenta").val(0);
		$("#totalVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);

	}else{

		// SUMAR TOTAL DE PRECIOS

    	sumarTotalPrecios()

    	// AGREGAR IMPUESTO
	        
        agregarImpuesto()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos()

	}

})



/*=============================================
AGREGANDO ACTIVOS DESDE EL BOTÓN PARA DISPOSITIVOS
=============================================*/

var numEquipo = null;

$(".btnAgregarProducto").click(function(){

	numEquipo ++;

	var datos = new FormData();
	datos.append("traerEquipos", "ok");

	$.ajax({

		url:"ajax/inventario.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
		    
      	    	$(".nuevoActivo").append( 

      	    		'<div class="mt16">'+

		          		'<div class="card-white-add-products row">'+
		                
			                '<div class="col-md-4 col-sm-4 col-xs-4">'+
			                    
			                    '<div class="input-group">'+
 
			                        '<span class="input-group-addon"><button type="button" class="btn btn-danger quitarProducto" idItem><i class="bx bx-x-circle"></i></button></span>'+

			                        '<select class="form-control  nuevaDescripcionActivo  select-buscador" id="equipo'+numEquipo+'" idItem name="nuevaDescripcionActivo"  required>'+

			                        	'<option>Seleccionar Activo</option>'+

			                        '</select>'+

			                    '</div>'+

			                '</div>'+


			                '<!-- SERIAL -->'+

			                '<div class="col-md-4 col-sm-4 col-xs-3 ingresoSerial mt16" style="width:30%; height: 20% !important;">'+
			                    
                       '<input type="text" class="form-control nuevoSerialActivo" name="nuevoSerialActivo" serial nuevoSerial  required>'+

			                '</div>'+

			            '</div>'+

			          '</div>'             

          	);

			//FUNCION SELECT2

			$('.select-buscador').select2({

				width: '100%'

			}); 

	        // AGREGAR LOS EQUIPOS AL SELECT 

	         respuesta.forEach(funcionForEach);

	         function funcionForEach(item, index){

	         	if(item.stock != 0){

		         	$("#equipo"+numEquipo).append(

						'<option idItem="'+item.id+'" value="'+item.tipoActivo+'">'+item.tipoActivo+'</option>'
		         	)

		         }

	         }

	       

      	}

	})

})

/*=============================================
SELECCIONAR PRODUCTO
=============================================*/
$(".formularioActa").on("change", "select.nuevaDescripcionActivo", function() {

    var nombreEquipo = $(this).val();

    var nuevaDescripcionActivo = $(this).parent().parent().parent().children().children().children(".nuevaDescripcionActivo");

    var nuevoSerialActivo = $(this).closest(".card-white-add-products").find(".nuevoSerialActivo");

	
 

    var datos = new FormData();
    datos.append("nombreEquipo", nombreEquipo);

    $.ajax({
        url: "ajax/inventario.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            console.log(respuesta);

			$(nuevaDescripcionActivo).attr("idInventario", respuesta[0].idInventario);
			$(nuevoSerialActivo).val(respuesta[0].serial);
			
        

            // AGRUPAR PRODUCTOS EN FORMATO JSON
            listarProductos();
        }
    });
});



/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos(){

	var listaProductos = [];

	var descripcion = $(".nuevaDescripcionActivo");

	var serial = $(".nuevoSerialActivo");

	for(var i = 0; i < descripcion.length; i++){

		listaProductos.push({
			"idInventario": $(descripcion[i]).attr("idInventario"), 
			"activo": $(descripcion[i]).val(),
			"serial": $(serial[i]).val()
		});
		

	}
	console.log("listaProductos", listaProductos);
	$("#listaProductos").val(JSON.stringify(listaProductos)); 

}


/*=============================================
BOTON EDITAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEditarVenta", function(){

	var idVenta = $(this).attr("idVenta");

	window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;


})

/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarProducto(){

	//Capturamos todos los id de productos que fueron elegidos en la venta
	var idProductos = $(".quitarProducto");

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaProductosVentas tbody button.agregarProducto");

	//Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
	for(var i = 0; i < idProductos.length; i++){

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(idProductos[i]).attr("idProducto");
		
		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for(var j = 0; j < botonesTabla.length; j ++){

			if($(botonesTabla[j]).attr("idProducto") == boton){

				$(botonesTabla[j]).removeClass("btn-primary agregarProducto");
				$(botonesTabla[j]).addClass("btn-table");

			}
		}

	}
	
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$('.tablaProductosVentas').on( 'draw.dt', function(){

	quitarAgregarProducto();

})



/*=============================================
BORRAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEliminarVenta", function(){

  var idVenta = $(this).attr("idVenta");
  var cuentaOculta = $(this).attr("cuentaOculta");

  Swal.fire({
  		icon: 'warning',
      title: 'Eliminar venta',
      text: "Se borrarán todos los datos de la venta",
      showCancelButton: true,
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Eliminar'
  }).then(function(result){
  if (result.value) {
          
      window.location = "index.php?ruta=ventas&idVenta="+idVenta+"&cuentaOculta="+cuentaOculta;
  }

  })

})

/*=============================================
IMPRIMIR FACTURA
=============================================*/
$(document).on("click", ".btnImprimir", function(){

	var id = $(this).attr("id");


	window.open("extensiones/fpdf/acta_entrega.php?id="+id, "_blank");

})



/*=============================================
PLUGGIN DE BUSCADOR EN SELECT
=============================================*/
$(document).ready(function() {
    
    $('.select-buscador').select2({

    		width: '100%'
    });    
    
});