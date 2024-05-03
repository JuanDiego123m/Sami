<?php

class ControladorUsuarios{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/

	static public function ctrIngresoUsuario(){

		if(isset($_POST["ingUsuario"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"])){

			   	$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "usuarios";

				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

				if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar){

					if($respuesta["estado"] == 1 ){

						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["usuario"] = $respuesta["usuario"];
						$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["perfil"] = $respuesta["perfil"];

						/*==============================================
						=            REGISTRAR FECHA Y HORA            =
						==============================================*/
						
						
						date_default_timezone_set('America/Bogota');

						$fecha = date('Y-m-d');
						$hora = date('H:i:s');

						$fechaActual = $fecha.' '.$hora;

						$item1 = "ultimo_login";
						$valor1 = $fechaActual;

						$item2 = "id";
						$valor2 = $respuesta["id"];

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

						if($ultimoLogin == "ok"){

							if($_SESSION["perfil"] == "Invitado"){

								echo '<script>

									window.location = "operaciones";

								</script>';

							}else{

								echo '<script>

									window.location = "inicio";

								</script>';

							}
	

						}
						

						
					}else{

						echo '<br><br><div class="alert alert-danger">Usuario desactivado</div>';

					}

				}else{

					echo '<br><br><div class="alert alert-danger">Usuario o contraseña incorrectos</div>';

				}

			}	

		}

	}

	/*=============================================
	NUEVO USUARIO
	=============================================*/

	static public function ctrCrearUsuario(){

		if(isset($_POST["nuevoUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"])){

				/*=============================================
				=            VALIDAR IMAGEN           =
				=============================================*/

				$ruta = "";

				if (!empty($_FILES["nuevaFoto"]["tmp_name"]) && file_exists($_FILES["nuevaFoto"]["tmp_name"])) {
					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
				} else {
					// Manejar el caso cuando el archivo no se ha cargado correctamente
					// y mostrar un mensaje de error o realizar alguna acción adecuada.
				}
				

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
				=            DIRECTORIO GUARDAR FOTO           =
				=============================================*/
					$directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];

					mkdir($directorio, 0755);

					/*=============================================
				=            FUNCIONES PHP POR TIPO IMAGEN            =
				=============================================*/

					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

						/*=============================================
				=           GUARDAR EN DIRECTORIO            =
				=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){

						/*=============================================
				=           GUARDAR EN DIRECTORIO            =
				=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}


				}
				
				
				

				$tabla = "usuarios";

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array("nombre" => $_POST["nuevoNombre"],
							   "usuario" => $_POST["nuevoUsuario"],
							   "password" => $encriptar,
							   "perfil" => $_POST["nuevoPerfil"],
							   "foto"=>$ruta);

				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

				if ($respuesta == "ok") {
					echo '<script>
						
						swal({

							type: "success",
							title: "¡Se guardó correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false,


							}).then((result)=>{

				
							if(result.value){
								window.location = "usuarios";
							}


						});

					  </script>';
				}

			}
		}


	/*=======================================
	=            MOSTRAR USUARIO            =
	=======================================*/
	
	static public function ctrMostrarUsuarios($item, $valor){

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;
	}


	/*=======================================
	=            EDITAR USUARIO            =
	=======================================*/


	static public function ctrEditarUsuario(){

		if(isset($_POST["editarUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

				/*======================================
				=            VALIDAR IMAGEN            =
				======================================*/
				
				$ruta = $_POST["fotoActual"];
				
				
				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
				=            DIRECTORIO GUARDAR FOTO           =
				=============================================*/
					$directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];

					/*================================================
					=            VALIDAR SI EXISTE IMAGEN  db          =
					================================================*/
					
					if(!empty($_POST["fotoActual"])){

						unlink($_POST["fotoActual"]);
					}else{

						mkdir($directorio, 0755);
					}
					
			

					/*=============================================
				=            FUNCIONES PHP POR TIPO IMAGEN            =
				=============================================*/

					if($_FILES["editarFoto"]["type"] == "image/jpeg"){

						/*=============================================
				=           GUARDAR EN DIRECTORIO            =
				=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarFoto"]["type"] == "image/png"){

						/*=============================================
				=           GUARDAR EN DIRECTORIO            =
				=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}


				}

				$tabla = "usuarios";

				if($_POST["editarPassword"] != ""){

					$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					
				}else{

					$encriptar = $passwordActual;
				}

				$datos = array("nombre" => $_POST["editarNombre"],
							   "usuario" => $_POST["editarUsuario"],
							   "password" => $encriptar,
							   "perfil" => $_POST["editarPerfil"],
							   "foto"=>$ruta);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>
						
						swal({

							type: "success",
							title: "Se guardaron los cambios",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false,


							}).then((result)=>{

				
							if(result.value){
								window.location = "usuarios";
							}


						});

					  </script>';


				}


			}else{
				echo '<script>
						
						swal({

							type: "error",
							title: "El nombre no puede estar vacío o llevar caracteres especiales",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false,


							}).then((result)=>{

				
							if(result.value){
								window.location = "usuarios";
							}


						});

					  </script>';
			}


		}
	}

	/*======================================
	=            BORRAR USUARIO            =
	======================================*/
	
	static public function ctrBorrarUsuario(){

		if(isset($_GET["idUsuario"])){

			$tabla ="usuarios";
			$datos = $_GET["idUsuario"];

			if($_GET["fotoUsuario"] != ""){

				unlink($_GET["fotoUsuario"]);
				rmdir('vistas/img/usuarios/'.$_GET["usuario"]);

			}

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Eliminado",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "usuarios";

								}
							})

				</script>';

			}		

		}

	}
	

	
}
	


