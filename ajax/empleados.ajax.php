<?php
require_once "../controladores/empleados.controlador.php";
require_once "../modelos/empleados.modelo.php";

class AjaxEmpleado{

	/*======================================
	=            EDITAR EMPLEADO            =
	======================================*/
	
	
	public $idItem;

	public function ajaxEditarEmpleado(){

		$item = "idEmpleado";
		$valor = $this->idItem;

		$respuesta = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

		echo json_encode($respuesta);


	}
	


/*=======================================
	=            ACTIVAR EMPLEADO            =
	=======================================*/
	public $activarEmpleado;
	public $activarId;


	public function ajaxActivarEmpleado(){

		$tabla = "empleados";

		$item1 = "estado";
		$valor1 = $this->activarEmpleado;

		$item2 = "idEmpleado";
		$valor2 = $this->activarId;

		$respuesta = ModeloEmpleados::mdlActualizarEmpleado($tabla, $item1, $valor1, $item2, $valor2);

	}

}


/*=======================================
	=            ACTIVAR OPERACION            =
	=======================================*/
	if(isset($_POST["activarEmpleado"])){

		$activarEmpleado = new AjaxEmpleado();
		$activarEmpleado -> activarEmpleado = $_POST["activarEmpleado"];
		$activarEmpleado -> activarId = $_POST["activarId"];
		$activarEmpleado -> ajaxActivarEmpleado();

	}

/*======================================
=            EDITAR EMPLEADO OBJ      = 
======================================*/


if(isset($_POST["idItem"])){

	$empleado = new AjaxEmpleado();
	$empleado -> idItem = $_POST["idItem"];
	$empleado -> ajaxEditarEmpleado();

}

