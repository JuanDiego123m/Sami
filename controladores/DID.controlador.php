<?php

class ControladorDID{

	/*=============================================
	MOSTRAR DID 
	=============================================*/

	static public function ctrMostrarDID($item, $valor){

		$tabla = "did";

		$respuesta = ModeloDID::mdlMostrarDID($tabla, $item, $valor);

		return $respuesta;

	}
	
	/*=============================================
	MOSTRAR TODOS DID 
	=============================================*/

	static public function ctrMostrarTodosLosDID($item, $valor){

		$tabla = "did";

		$respuesta = ModeloDID::mdlMostrarTodosLosDID($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR DID
	=============================================*/

	static public function ctrCrearDID(){

		
		if(isset($_POST["nuevaOperacion"])){

			if(preg_match('/^[#\-\_\.\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaOperacion"])){

			   	$tabla = "did";

			   	$datos = array("id_cliente"=>$_POST["nuevoCliente"],
			   	               "did"=>$_POST["nuevoDid"],
					           "operacion"=>$_POST["nuevaOperacion"],
					           "troncales"=>$_POST["nuevoTroncal"],
							   "proveedor"=>$_POST["nuevoProveedor"],
							   "ciudad"=>$_POST["nuevaCiudad"]);


				$respuesta = ModeloDID::mdlIngresarDID($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "¡Hecho!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "DID";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "No puedes dejar campos vacíos o con caracteres especiales",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "DID";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	EDITAR DID
	=============================================*/

	static public function ctrEditarDID(){

		if(isset($_POST["editarDID"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDID"])){

			   	$tabla = "did";

			   	$datos = array("idDid"=>$_POST["idDid"],
			   				   "id_cliente"=>$_POST["editarCliente"],
			   				   "did"=>$_POST["editarDID"],
					           "operacion"=>$_POST["editarOperaciones"],
					           "troncales"=>$_POST["editarTroncal"],
					           "proveedor"=>$_POST["editarProveedor"],
					       	   "ciudad"=>$_POST["editarCiudad"]);


				$respuesta = ModeloDID::mdlEditarDID($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "¡Hecho!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then((result) => {
										if (result.value) {

										window.location = "index.php?ruta=editar-DID&idDID='.$_POST["idDid"].'";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "No puedes dejar campos vacíos o con caracteres especiales",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then((result) => {
							if (result.value) {

							window.location = "index.php?ruta=editar-DID&idDID='.$_POST["idDid"].'";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	BORRAR DID
	=============================================*/
	static public function ctrEliminarDID(){

		if(isset($_GET["idD"])){

			$tabla = "did";
			$datos = $_GET["idD"];

			$respuesta = ModeloDID::mdlBorrarDID($tabla, $datos);

			if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Eliminado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "DID";

									}
								})

					</script>';
			}		
		}


	}


}