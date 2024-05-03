<?php
require_once "../controladores/operaciones.controlador.php";
require_once "../modelos/operaciones.modelo.php";

class AjaxOperacion{

	/*======================================
	=            EDITAR OPERACION            =
	======================================*/
	
	
	public $id;

	public function ajaxEditarOperacion(){

		$item = "id";
		$valor = $this->id;

		$respuesta = ControladorOperaciones::ctrMostrarOperacion($item, $valor);

		echo json_encode($respuesta);


	}
	


/*=======================================
	=            ACTIVAR OPERACIÓN            =
	=======================================*/
	
	public $activarOperacion;
	public $activarId;


	public function ajaxActivarOperacion(){

		$tabla = "operaciones";

		$item1 = "estado";
		$valor1 = $this->activarOperacion;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ModeloOperaciones::mdlActualizarOperacion($tabla, $item1, $valor1, $item2, $valor2);

	}

}


/*=======================================
	=            ACTIVAR OPERACION            =
	=======================================*/
	if(isset($_POST["activarOperacion"])){

		$activarOperacion = new AjaxOperacion();
		$activarOperacion -> activarOperacion = $_POST["activarOperacion"];
		$activarOperacion -> activarId = $_POST["activarId"];
		$activarOperacion -> ajaxActivarOperacion();

	}

/*======================================
=            EDITAR EMPLEADO OBJ      = 
======================================*/


if(isset($_POST["id"])){

	$operacion = new AjaxOperacion();
	$operacion -> id = $_POST["id"];
	$operacions -> ajaxEditarOperacion();

}