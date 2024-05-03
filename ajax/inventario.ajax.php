<?php
require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";

class AjaxInventario{

	/*=============================================
  EDITAR PRODUCTO
  =============================================*/ 
  public $idItem;
  public $traerEquipos;
  public $nombreEquipo;

  public function ajaxEditarItem(){

    if($this->traerEquipos == "ok"){

      $item = null;
      $valor = null;
      $orden = "idInventario";

      $respuesta = ControladorInventario::ctrMostrarItems($item, $valor, $orden);

      echo json_encode($respuesta);


    }else if($this->nombreEquipo != ""){

      $item = "tipoActivo";
      $valor = $this->nombreEquipo;
      $orden = "idInventario";

      $respuesta = ControladorInventario::ctrMostrarItems($item, $valor,$orden);

      echo json_encode($respuesta);

    }else{

		$item = "idInventario";
    $valor = $this->idItem;
    $orden = "idInventario";

		$respuesta = ControladorInventario::ctrMostrarItems($item, $valor, $orden);

		echo json_encode($respuesta);

    }

  }

}

/*======================================
=            EDITAR ITEM OBJ      =
======================================*/


if(isset($_POST["idItem"])){

	$inventario = new AjaxInventario();
	$inventario -> idItem = $_POST["idItem"];
	$inventario -> ajaxEditarItem();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["traerEquipos"])){

	$traerEquipos = new AjaxInventario();
	$traerEquipos -> traerEquipos = $_POST["traerEquipos"];
	$traerEquipos -> ajaxEditarItem();
  
  }
  
  /*=============================================
TRAER EQUIPOS
=============================================*/ 

if(isset($_POST["nombreEquipo"])){

  $traerEquipos = new AjaxInventario();
  $traerEquipos -> nombreEquipo = $_POST["nombreEquipo"];
  $traerEquipos -> ajaxEditarItem();

}
  