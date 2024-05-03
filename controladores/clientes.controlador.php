<?php

class ControladorClientes{


	/*=====================================
	=            CREAR CLIENTE            =
	=====================================*/
	static public function ctrCrearCliente(){

		if (isset($_POST["nombreCliente"])) {
			if (preg_match('/^[#\-\_\.\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreCliente"])) {
				$tabla = "clientess";

				$datos = array(
					"nombre" => $_POST["nombreCliente"],
					"nit" => $_POST["nuevoNit"]
				);
	
				// Verificar si el cliente ya existe en la base de datos
				$existeCliente = ModeloClientes::verificarExistenciaCliente($tabla, $_POST["nombreCliente"]);
	
				if ($existeCliente) {
					echo '<script>
						swal({
							type: "error",
							title: "¡El cliente ya existe!",
							text: "No se puede agregar un cliente duplicada.",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result) {
							if (result.value) {
								window.location = "clientes";
							}
						});
					</script>';
				} else {
					$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);
	
					if ($respuesta == "ok") {
						echo '<script>
							swal({
								type: "success",
								title: "¡Hecho!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then(function(result) {
								if (result.value) {
									window.location = "clientes";
								}
							});
						</script>';
					}
				}
			} else {
				echo '<script>
					swal({
						type: "error",
						title: "¡Asegúrate de no enviar campos vacíos o con caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result) {
						if (result.value) {
							window.location = "clientes";
						}
					});
				</script>';
			}
		}
	}

	/*========================================
	=            MOSTRAR CLIENTES            =
	========================================*/
	
	static public function ctrMostrarClientes($item, $valor){

		$tabla = "clientess";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

		return $respuesta;
	}



	/*=====================================
	=            EDITAR CLIENTE            =
	=====================================*/

	static public function ctrEditarCliente(){

		if(isset($_POST["editarCliente"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarNit"])){

			   	$tabla = "clientess";

			   	$datos = array("idCliente"=>$_POST["idCliente"],
			   				   "nombre"=>$_POST["editarCliente"],
					           "nit"=>$_POST["editarNit"]);


			   	$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "¡Hecho!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

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

							window.location = "clientes";

							}
						})

			  	</script>';

 

			}

		}

	}

	/*========================================
	=            ELIMINAR CLIENTE            =
	========================================*/
	static public function ctrEliminarCliente(){

		if(isset($_GET["id"])){

			$tabla = "clientess";
			$datos = $_GET["id"];

			$respuesta = ModeloClientes::mdlBorrarCliente($tabla, $datos);

			if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Eliminado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';
			}		
		}


	}

	
	/*=============================================
	CARGA MASIVA CLIENTES USANDO LIBRERIA SPREADSHEETREADER
	=============================================*/

	static public function ctrCargaMasivaClientes(){

		if(isset($_FILES['fileClients'])){

			require_once "vistas/plugins/SpreadsheetReader/spreadsheetReader.php";

			date_default_timezone_set('America/Bogota');

			$fechaD = date('Y-m-d');
			$hora = date('H:i:s');
			$fecha = $fechaD.' '.$hora;
                            
	        if($_FILES['fileClients']['name'] != null){

	        	$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];


	        	if(in_array($_FILES["fileClients"]["type"],$allowedFileType)){

	        		mkdir('public/uploads/tmp_files/'.'/', 755);

			        $targetPath = 'public/uploads/tmp_files/'.'/'.$_FILES['fileClients']['name'];

			        move_uploaded_file($_FILES['fileClients']['tmp_name'], $targetPath);
			        
			       	$Reader = new SpreadsheetReader($targetPath);
			        
			        $sheetCount = count($Reader->sheets());

		        	for($i=0;$i<$sheetCount;$i++){
			            $Reader->ChangeSheet($i);

						$isFirstRow = true; // Variable para verificar si es la primera fila

						foreach ($Reader as $Row) {

							if ($isFirstRow) {
								$isFirstRow = false;
								continue; // Saltar la primera fila
							}
			          
			                $nombreCliente = "";
			                if(isset($Row[0])) {
			                    $nombreCliente = $Row[0];
			                }
			                
			                $nitCliente = "";
			                if(isset($Row[1])) {
			                    $nitCliente = $Row[1];
			                }
			                
			                if (!empty($nombreCliente) || !empty($nitCliente)) {

			                    $tabla = "clientess";

							   	$datos = array("nombre" => trim($nombreCliente),
									           "nit"=>$nitCliente);

							   	$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

								if($respuesta == "ok"){

									echo'
									<script>

										swal({
											type: "success",
											title: "¡Carga Completada!",
											showConfirmButton: true,
											confirmButtonText: "Cerrar"
										}).then(function(result){
											if (result.value) {

												window.location = "clientes";

											}
										})

									</script>';

								}else{

									echo json_encode($respuesta);

								}

			                }

			            }
			        
			        }					

				}else{

					echo'
					<script>

						swal({
							type: "error",
							title: "¡Tipo de archivo no permitido!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result){
							if (result.value) {

								window.location = "clientes";

							}
						})

					</script>';

				}

			}

		}
		
	}
}

