<?php
require_once "../controladores/DID.controlador.php";
require_once "../modelos/DID.modelo.php";

class AjaxDid{

	/*======================================
	=            EDITAR DID            =
	======================================*/
	
	
	public $idDid;

	public function ajaxEditarDID(){

		$item = "idDid";
		$valor = $this->idDid;

		$respuesta = ControladorDID::ctrMostrarDID($item, $valor);

		echo json_encode($respuesta);


	}
	
}

/*======================================
=            EDITAR DID OBJ      = 
======================================*/


if(isset($_POST["idDid"])){

	$DID = new AjaxDid();
	$DID -> idDid = $_POST["idDid"];
	$DID -> ajaxEditarDID();

}