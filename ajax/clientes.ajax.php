<?php
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{

	/*======================================
	=            EDITAR CLEINTE            =
	======================================*/
	
	
	public $idCliente;

	public function ajaxEditarCliente(){

		$item = "idCliente";
		$valor = $this->idCliente;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);


	}
	
}

/*======================================
=            EDITAR CLIENTE OBJ      = 
======================================*/


if(isset($_POST["idCliente"])){

	$cliente = new AjaxClientes();
	$cliente -> idCliente = $_POST["idCliente"];
	$cliente -> ajaxEditarCliente();

}