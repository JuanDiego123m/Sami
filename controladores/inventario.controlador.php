<?php

class ControladorInventario{


	/*=====================================
	=            CREAR INVENTARIO         =
	=====================================*/
	
	static public function ctrCrearItem(){

		if(isset($_POST["nuevoEstado"])){

			if(preg_match('/^[#\.\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoEstado"])){

			   	$tabla = "inventario";

			   	$datos = array("propietario"=>$_POST["nuevoPropietario"],
								"tipoActivo"=>$_POST["nuevotipoActivo"],
					           "serial"=>$_POST["nuevoSerial"],
							   "estado"=>$_POST["nuevoEstado"],
					           "propietario"=>$_POST["nuevoPropietario"],
							   "notas"=>$_POST["nuevaNota"]);

			   	$respuesta = ModeloInventario::mdlIngresarItem($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "¡Hecho!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "inventario";

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

							window.location = "inventario";

							}
						})

			  	</script>';



			}

		}

	}
	

	/*========================================
	=            MOSTRAR ITEMS               =
	========================================*/
	
	static public function ctrMostrarItems($item, $valor){

		$tabla = "inventario";

		$respuesta = ModeloInventario::mdlMostrarItems($tabla, $item, $valor);

		return $respuesta;
	}

	


	/*=====================================
	=            EDITAR INVENTARIO        =
	=====================================*/

		static public function ctrEditarInventario(){

		if(isset($_POST["editarItem"])){

			if(preg_match('/^[#\-\_\.\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarItem"])){

				date_default_timezone_set('America/Bogota');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');

				$fechaModificacion= $fecha.' '.$hora;

			   	$tabla = "inventario";

				   $datos = array(
					"idInventario" => $_POST["editarItem"],
					"id_empleado" => $_POST["editarPropietario"],
					"tipoActivo" => $_POST["editarActivo"],
					"serial" => $_POST["editarSerial"],
					"estado" => $_POST["editarEstado"],
					"propietario" => $_POST["editarPropietario"],
					"notas" => $_POST["editarNotas"],
					"ultima_modificacion" => $fechaModificacion
				 );
				 

			   	$respuesta = ModeloInventario::mdlEditarInventario($tabla, $datos);

			   

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "¡Hecho!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "inventario";

									}
								})

					</script>';
				


				}else{
					echo'<script>

							swal({
								  type: "error",
								  title: "Ocurrió un error al tratar de modificar los datos",
								  showConfirmButton: true,
								  confirmButtonText: "Cerrar"
								  }).then(function(result){
									if (result.value) {

									window.location = "inventario";

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

								window.location = "inventario";

								}
							})

				  	</script>';



			}

		}

	}
	/*=====================================
	=            ELIMINAR INVENTARIO        =
	=====================================*/
	static public function ctrEliminarInventario(){

		if(isset($_GET["idInventa"])){

			$tabla = "inventario";
			$datos = $_GET["idInventa"];

			$respuesta = ModeloInventario::mdlBorrarInventario($tabla, $datos);

			if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Eliminado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "inventario";

									}
								})

					</script>';
			}		
		}


	}

	/*=====================================
	=       CARGA MASIVA INVENTARIO  USANDO LIBRERIA SPREADSHEETREADER =
	=====================================*/

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

						$isFirstRow = true; // Variable para verificar si es la primera fila

						foreach ($Reader as $Row) {

							if ($isFirstRow) {
								$isFirstRow = false;
								continue; // Saltar la primera fila
							}
			          
			                $nombreEmpleado = "";
			                if(isset($Row[0])) {
			                    $nombreEmpleado = $Row[0];
			                }
			                
			                $tipoActivo = "";
			                if(isset($Row[1])) {
			                    $tipoActivo = $Row[1];
			                }

			                $serialActivo = "";
			                if(isset($Row[2])) {
			                    $serialActivo = $Row[2];
			                }

			                $estadoItem = "";
			                if(isset($Row[3])) {
			                    $estadoItem = $Row[3];
			                }

			                $propietarioItem = "";
			                if(isset($Row[4])) {
			                    $propietarioItem = $Row[4];
			                }

			                $notaItem = "";
			                if(isset($Row[5])) {
			                    $notaItem = $Row[5];
			                }
			                
			                if (!empty($nombreEmpleado) || !empty($tipoActivo)) {

			                    $tabla = "inventario";

							   	$datos = array("id_empleado" => trim($nombreEmpleado),
									           "tipoActivo"=>$tipoActivo,
									           "serial" => $serialActivo,
									           "estado"=>trim($estadoItem),
									           "propietario"=>trim($propietarioItem),
									           "notas"=>trim($notaItem));

							   	$respuesta = ModeloInventario::mdlIngresarItem($tabla, $datos);

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

												window.location = "inventario";

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

								window.location = "inventario";

							}
						})

					</script>';

				}

			}

		}
		
	}

	
	
}