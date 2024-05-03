<?php
require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";

class AjaxActa{

	/*=============================================
  EDITAR ACTA
  =============================================*/ 
  public $idItem;
  public $traerEquipos;
  public $nombreEquipo;

  public function ajaxEditarItem(){

    if($this->traerEquipos == "ok"){

      $item = null;
      $valor = null;

      $respuesta = ControladorInventario::ctrMostrarItems($item, $valor);

      echo json_encode($respuesta);


    }else if($this->nombreEquipo != ""){

      $item = "tipoActivo";
      $valor = $this->nombreEquipo;

      $respuesta = ControladorInventario::ctrMostrarItems($item, $valor);

      echo json_encode($respuesta);

    }else{

		$item = "idInventario";
		$valor = $this->idItem;

		$respuesta = ControladorInventario::ctrMostrarItems($item, $valor);

		echo json_encode($respuesta);

    }

  }

}


/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["traerEquipos"])){

	$traerEquipos = new AjaxActa();
	$traerEquipos -> traerEquipos = $_POST["traerEquipos"];
	$traerEquipos -> ajaxEditarItem();
  
  }
  
  
  /*=============================================
  TRAER PRODUCTO
  =============================================*/ 
  
  if(isset($_POST["nombreEquipo"])){
  
	$traerEquipos = new AjaxActa();
	$traerEquipos -> nombreEquipo = $_POST["nombreEquipo"];
	$traerEquipos -> ajaxEditarItem();
  
  }