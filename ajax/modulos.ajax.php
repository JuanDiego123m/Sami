<?php
require_once "../controladores/Modulos.controlador.php";
require_once "../modelos/Modulos.modelo.php";

class AjaxModulos{

	/*======================================
	=            EDITAR MODULO            =
	======================================*/
	
	
	public $idModulo;

	public function ajaxEditarModulo(){

		$item = "id";
		$valor = $this->idModulo;

		$respuesta = ControladorModulos::ctrMostrarModulos($item, $valor);

		echo json_encode($respuesta);


	}
	
}

/*======================================
=            EDITAR Modulo OBJ      =
======================================*/


if(isset($_POST["idModulo"])){

	$modulo = new AjaxModulos();
	$modulo -> idModulo = $_POST["idModulo"];
	$modulo -> ajaxEditarModulo();

}