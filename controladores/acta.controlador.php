<?php

class ControladorActa{


	/*=====================================
	=            CREAR ACTA         =
	=====================================*/
	static public function ctrCrearActa() {
		if (isset($_POST["seleccionarEmpleado"])) {
			$tabla = "actas";
			$listaProductos = json_decode($_POST["listaProductos"], true);
			
			/** Subida de imagen firma mesa*/
			$firma_mesa = $_FILES['firmamesa']['name'];
			$tipo_firma_mesa = $_FILES['firmamesa']['type'];
			$peso_firma_mesa = $_FILES['firmamesa']['size'];
			$ruta_firma_mesa= $_FILES['firmamesa']['tmp_name'];
			$destino_img_mesa = 'vistas/img/firmas/'.$firma_mesa;
			$destino_firma_mesa = "../../vistas/img/firmas/" . $firma_mesa;
			/** Subida de imagen firma empleado*/
			$firma_empleado = $_FILES['firmaempleado']['name'];
			$tipo_firma_empleado = $_FILES['firmaempleado']['type'];
			$peso_firma_empleado = $_FILES['firmaempleado']['size'];
			$ruta_firma_empleado = $_FILES['firmaempleado']['tmp_name'];
			$destino_img = 'vistas/img/firmas/'.$firma_empleado;
			$destino_firma_empleado = "../../vistas/img/firmas/" . $firma_empleado;

			if ($firma_mesa != ""){
				copy($ruta_firma_mesa, $destino_img_mesa);
			}
			if ($firma_empleado != ""){
				copy($ruta_firma_empleado, $destino_img);
			}
			$datos = array(
				"codigo" => $_POST["nuevaActa"],
				"id_empleado" => $_POST["seleccionarEmpleado"],
				"id_inventario" => $_POST["listaProductos"],
				"fecha" => $_POST["nuevaFecha"],
				"descripcion" => trim($_POST["nuevaDescripcion"]),
				"firma_mesa" => $destino_firma_mesa,
				"firma_empleado" => $destino_firma_empleado
			);
	
			$respuesta = ModeloActa::mdlIngresarActa($tabla, $datos);
	
			if ($respuesta == "ok") {
				$listaProductos = json_decode($_POST["listaProductos"], true);
	
				foreach ($listaProductos as $key => $value) {
					$tablaInventario = "inventario";
	
					$item1 = "estado";
					$valor1 = "Asignado";
	
					$item2 = "propietario";
					$valor2 = $_POST["seleccionarEmpleado"];
	
					$item3 = "idInventario";
					$valor3 = $value["idInventario"];
	
					$respuestaInventario = ModeloInventario::mdlActualizarItem($tablaInventario, $item1, $valor1, $item2, $valor2, $item3, $valor3);
				}
	
			   echo '<script>
				   swal({
					   type: "success",
					   title: "¡Hecho!",
					   showConfirmButton: true,
					   confirmButtonText: "Cerrar"
				   }).then((result) => {
					   if (result.value) {
						   window.location = "acta";
					   }
				   });
			   </script>';
			}
		}
	}
	

	 /*======================================
    =       MOSTRAR ULTIMO CODIGO VENTA   =
    ======================================*/
  
    static public function ctrMostrarUltimoCodigoActa($item, $valor){

        $tabla = "actas";

        $respuesta = ModeloActa::mdlMostrarUltimoCodigoActa($tabla, $item, $valor);

        return $respuesta;
    }

	/*========================================
	=            MOSTRAR ACTA           =
	========================================*/
	
	static public function ctrMostrarActa($item, $valor){

		$tabla = "actas";

		$respuesta = ModeloActa::mdlMostrarActa($tabla, $item, $valor);

		return $respuesta;
	}

		/*========================================
	=            ELIMINAR ACTA           =
	========================================*/
	static public function ctrEliminarActa(){

		if(isset($_GET["idActa"])){

			$tabla = "actas";
			$datos = $_GET["idActa"];
			$respuesta = ModeloActa::mdlBorrarActa($tabla, $datos);

			if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Eliminado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "acta";

									}
								})

					</script>';
			}		
		}


	}

	
}