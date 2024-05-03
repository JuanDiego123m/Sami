<?php

class ControladorEmpleados{


	/*=====================================
	=            CREAR EMPLEADO            =
	=====================================*/
	static public function ctrCrearEmpleado(){

		if (isset($_POST["nuevoEmpleado"])) {
			if (preg_match('/^[#\-\_\.\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoEmpleado"])&&
				preg_match('/^[0-9]+$/', $_POST["nuevoDocumento"]) && 
				preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"])){
				$tabla = "empleados";
	
				$datos = array(
					"nombre" => $_POST["nuevoEmpleado"],
					"documento" => $_POST["nuevoDocumento"],
					"telefono" => $_POST["nuevoTelefono"],
					"area"=>$_POST["nuevaArea"],
					"cargo"=>$_POST["nuevoCargo"],
					"estado" => 1
				);
	
				// Verificar si el empleado ya existe en la base de datos
				$existeEmpleado = ModeloEmpleados::verificarExistenciaEmpleado($tabla, $_POST["nuevoEmpleado"]);
	
				if ($existeEmpleado) {
					echo '<script>
						swal({
							type: "error",
							title: "¡El empleado ya existe!",
							text: "No se puede agregar un empleado duplicado.",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result) {
							if (result.value) {
								window.location = "empleados";
							}
						});
					</script>';
				} else {
					$respuesta = ModeloEmpleados::mdlRegistrarEmpleado($tabla, $datos);
	
					if ($respuesta == "ok") {
						echo '<script>
							swal({
								type: "success",
								title: "¡Hecho!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then(function(result) {
								if (result.value) {
									window.location = "empleados";
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
							window.location = "empleados";
						}
					});
				</script>';
			}
		}
	}
	/*========================================
	=            MOSTRAR EMPLEADOS            =
	========================================*/
	
	static public function CtrMostrarEmpleados($item, $valor){

		$tabla = "empleados";

		$respuesta = ModeloEmpleados::mdlMostrarEmpleados($tabla, $item, $valor);

		return $respuesta;
	}

	
	/*=====================================
	=            EDITAR EMPLEADO            =
	=====================================*/

	static public function ctrEditarEmpleado(){

		if(isset($_POST["editarEmpleado"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarEmpleado"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarDocumentoId"]) &&
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"])){

			   	$tabla = "empleados";

			   	$datos = array("idEmpleado"=>$_POST["editarEmpleado"],
			   				   "nombre"=>$_POST["editarNombre"],
					           "documento"=>$_POST["editarDocumentoId"],
					           "telefono"=>$_POST["editarTelefono"],
					           "area"=>$_POST["editarArea"],
					       	   "cargo"=>$_POST["editarCargo"]);

				$estado = 1;


			   	$respuesta = ModeloEmpleados::mdlEditarEmpleado($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "¡Hecho!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "empleados";

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

							window.location = "empleados";

							}
						})

			  	</script>';



			}

		}

	}

	/*========================================
	=            ELIMINAR EMPLEADO            =
	========================================*/
	static public function ctrEliminarEmpleado(){

		if(isset($_GET["idEmplea"])){

			$tabla = "empleados";
			$datos = $_GET["idEmplea"];

			$respuesta = ModeloEmpleados::mdlBorrarEmpleado($tabla, $datos);

			if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Eliminado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "empleados";

									}
								})

					</script>';
			}		
		}


	}


	/*=============================================
	CARGA MASIVA EMPLEADOS  USANDO LIBRERIA SPREADSHEETREADER
	=============================================*/

	static public function ctrCargaMasivaItems(){

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
			            
			            foreach ($Reader as $Row){
			          
			                $nombreEmpleado = "";
			                if(isset($Row[0])) {
			                    $nombreEmpleado = $Row[0];
			                }
			                
			                $documentoEmpleado = "";
			                if(isset($Row[1])) {
			                    $documentoEmpleado = $Row[1];
			                }

			                $telefonoEmpleado = "";
			                if(isset($Row[2])) {
			                    $telefonoEmpleado = $Row[2];
			                }

			                $areaEmpleado = "";
			                if(isset($Row[3])) {
			                    $areaEmpleado = $Row[3];
			                }

			                $cargoEmpleado = "";
			                if(isset($Row[4])) {
			                    $cargoEmpleado = $Row[4];
			                }
			                
			                if (!empty($nombreEmpleado) || !empty($documentoEmpleado)) {

			                    $tabla = "empleados";

							   	$datos = array("nombre" => trim($nombreEmpleado),
									           "documento"=>$documentoEmpleado,
									           "telefono"=>$telefonoEmpleado,
									           "area"=>trim($areaEmpleado),
									           "cargo"=>trim($cargoEmpleado),
									           "estado" => 1);

							   	$respuesta = ModeloEmpleados::mdlRegistrarEmpleado($tabla, $datos);

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

												window.location = "empleados";

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

								window.location = "empleados";

							}
						})

					</script>';

				}

			}

		}
		
	}


}