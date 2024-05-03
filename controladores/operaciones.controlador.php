<?php

class ControladorOperaciones{


	/*=====================================
	=            CREAR OPERACION               =
	=====================================*/
	static public function ctrCrearOperacion(){

    if (isset($_POST["nuevoCliente"])) {
        if (preg_match('/^[#\-\_\.\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"])) {
            $tabla = "operaciones";

            $estado = isset($_POST["callCenter"]) ? 1 : 0;

            $datos = array(
                "id_cliente" => $_POST["nuevoCliente"],
                "usuario" => $_POST["nuevoUsuario"],
                "password" => $_POST["nuevoPassword"],
                "estado" => $estado
            );

            // Verificar si la operación ya existe en la base de datos
            $existeOperacion = ModeloOperaciones::verificarExistenciaOperacion($tabla, $_POST["nuevoUsuario"]);

            if ($existeOperacion) {
                
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡La operación ya existe!",
                        text: "No se puede agregar una operación duplicada.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result) {
                        if (result.value) {
                            window.location = "operaciones";
                        }
                    });
                </script>';
                
            } else {
                $respuesta = ModeloOperaciones::mdlRegistrarOperacion($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        swal({
                            type: "success",
                            title: "¡Hecho!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result) {
                            if (result.value) {
                                window.location = "operaciones";
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
                        window.location = "operaciones";
                    }
                });
            </script>';
        }
    }
}

	/*========================================
	=            MOSTRAR OPERACION               =
	========================================*/
	
	static public function ctrMostrarOperacion($item, $valor){

		$tabla = "operaciones";

		$respuesta = ModeloOperaciones::mdlMostrarOperacion($tabla, $item, $valor);

		return $respuesta;
	}

	/*========================================
	=            MOSTRAR OPERACION  2       =
	========================================*/
	
	static public function ctrMostrarOperacionb($itemb, $valorb){

		$tablab = "operaciones";

		$respuesta = ModeloOperaciones::mdlMostrarOperacionb($tablab, $itemb, $valorb);

		return $respuesta;	
	}


	/*=====================================
	=            EDITAR OPERACION        =
	=====================================*/

	static public function ctrEditarOperacion(){

		if(isset($_POST["editarId"])){

			if(preg_match('/^[#\-\_\.\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarId"])){

			   $tabla = "operaciones";

				   $datos = array("id"=>$_POST["editarId"],
				   "cliente"=>$_POST["editarNombre"],
				   "usuario"=>$_POST["editarUsuario"],
				   "password"=>$_POST["editarPassword"],
				   "idCliente"=>$_POST["idCliente"]
				);

			   	$respuesta = ModeloOperaciones::mdlEditarOperacion($tabla, $datos);

			   

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "¡Hecho!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "operaciones";

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

									window.location = "operaciones";

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

								window.location = "operaciones";

								}
							})

				  	</script>';



			}

		}

	}

	
/*========================================
	=            ELIMINAR OPERACION            =
	========================================*/
	
static public function ctrEliminarOperacion(){

		if(isset($_GET["idOperacion"])){

			$tabla = "operaciones";
			$datos = $_GET["idOperacion"];

			$respuesta = ModeloOperaciones::mdlBorrarOperacion($tabla, $datos);

			if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Eliminado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "operaciones";

									}
								})

					</script>';
			}		
		}


	}
	
}