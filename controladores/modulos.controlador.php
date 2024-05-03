<?php

class ControladorModulos{


	/*=====================================
	=            CREAR MODULO           =
	=====================================*/
	
	
	static public function ctrCrearModulo(){

		if(isset($_POST["nuevoModulo"])){

			if(preg_match('/^[#\-\_\.\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoModulo"]) &&
			   preg_match('/^[#\.\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["seleccionarCliente"]) &&
			   preg_match('/^[#\.\_\.\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoUsuario"]) &&
			   preg_match('/^[#\*\_\/\-\#\@\.\:\-a-zA-Z0-9 ]+$/', $_POST["nuevaPassword"]) && 
			   preg_match('/^[#\*\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaLicc"]) && 
			   preg_match('/^[#\*\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaLicPbx"]) &&
			   preg_match('/^[#\*\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaRedes"]) && 
			   preg_match('/^[#\*\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaIp"])){

			   	$tabla = "modulos";

			   	$datos = array("nombre"=>$_POST["nuevoModulo"],
					           "id_cliente"=>$_POST["seleccionarCliente"],
					           "usuario"=>$_POST["nuevoUsuario"],
					           "password"=>$_POST["nuevaPassword"],
					           "lic_cc"=>$_POST["nuevaLicc"],
					           "lic_pbx"=>$_POST["nuevaLicPbx"],
					           "redes"=>$_POST["nuevaRedes"],
					           "ip_servidor"=>$_POST["nuevaIp"]);

			   	$respuesta = ModeloModulos::mdlIngresarModulo($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "¡Hecho!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "modulos";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Asegurate de no enviar campos vacíos o con caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "modulos";

							}
						})

			  	</script>';



			}

		}

	}

	/*========================================
	=            MOSTRAR MODULOS           =
	========================================*/
	
	static public function ctrMostrarModulos($item, $valor){

		$tabla = "modulos";

		$respuesta = ModeloModulos::mdlMostrarModulos($tabla, $item, $valor);

		return $respuesta;
	}

	/*========================================
	=            MOSTRAR MODULOS 2          =
	========================================*/
	
	static public function ctrMostrarModulosb($itemb, $valorb){

		$tablab = "modulos";

		$respuesta = ModeloModulos::mdlMostrarModulosb($tablab, $itemb, $valorb);

		return $respuesta;
	}

	/*=====================================
	=            EDITAR MODULOS          =
	=====================================*/

	static public function ctrEditarModulo(){

		if(isset($_POST["editarModulo"])){

			if(isset($_POST['operacionCc'])){
				$operacionCc = 1;
			}else{
				$operacionCc = 0;
			}

			if(preg_match('/^[#\-\_\.\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarModulo"]) &&
			   preg_match('/^[#\-\_\.\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"]) &&
			   preg_match('/^[#\-\_\.\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarUsuario"]) &&
			   preg_match('/^[#\-\_\.\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarPassword"]) && 
			   preg_match('/^[#\*\.\-a-zA-Z0-9 ]+$/', $_POST["editarLicc"]) && 
			   preg_match('/^[#\*\.\-a-zA-Z0-9 ]+$/', $_POST["editarLicPbx"]) &&
			   preg_match('/^[#\*\.\-a-zA-Z0-9 ]+$/', $_POST["editarRedes"]) && 
			   preg_match('/^[#\*\.\-a-zA-Z0-9 ]+$/', $_POST["editarIp"])){

			   	$tabla = "modulos";

			   	$datos = array("id"=>$_POST["idModulo"],
			   				   "nombre"=>$_POST["editarModulo"],
					           "id_cliente"=>$_POST["editarCliente"],
					           "usuario"=>$_POST["editarUsuario"],
					           "password"=>$_POST["editarPassword"],
					           "lic_cc"=>$_POST["editarLicc"],
					           "lic_pbx"=>$_POST["editarLicPbx"],
					           "redes"=>$_POST["editarRedes"],
					           "ip_servidor"=>$_POST["editarIp"],
					       	   "operacion_cc"=>$operacionCc);


			   	$respuesta = ModeloModulos::mdlEditarModulo($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "¡Hecho!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "modulos";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "Asegurate de no enviar campos vacíos o con caracteres especiales",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "modulos";

							}
						})

			  	</script>';



			}

		}

	}

	/*========================================
	=            ELIMINAR MODULO            =
	========================================*/
	
	
	static public function ctrEliminarModulo(){

		if(isset($_GET["idModulod"])){

			$tabla = "modulos";
			$datos = $_GET["idModulod"];

			$respuesta = ModeloModulos::mdlEliminarModulo($tabla, $datos);

			if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "¡Hecho!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "modulos";

									}
								})

					</script>';

			}

		}


	}
	
	
}