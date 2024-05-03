<?php

require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";

class TablaInventario{

 	/*=============================================
 	 MOSTRAR LA TABLA DE INVENTARIO
  	=============================================*/ 

	public function mostrarTablaInventario(){

		$item = null;
    	$valor = null;

  		$inventario = ControladorInventario::ctrMostrarItems($item, $valor);	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($inventario); $i++){

		  

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

              $botones = "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$inventario[$i]["idInventario"]."'>+</button></div>";

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$inventario[$i]["tipoActivo"].'",
			      "'.$inventario[$i]["serial"].'",
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE INVENTARIO
=============================================*/ 
$activarInventario = new TablaInventario();
$activarInventario -> mostrarTablaInventario();

