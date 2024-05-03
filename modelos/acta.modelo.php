<?php

require_once "conexion.php";

class ModeloActa{

	/*======================================
	=            MOSTRAR ITEMS           =
	======================================*/
	
	static public function mdlMostrarActa($tabla, $item, $valor){

		
		if($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetchAll();
        

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*======================================
	=           REGISTRO ITEMS           =
	======================================*/

	static public function mdlIngresarActa($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla ( codigo,id_empleado, id_inventario,fecha, descripcion, firma_mesa, firma_empleado) VALUES ( :codigo, :id_empleado, :id_inventario, :fecha, :descripcion, :firma_mesa, :firma_empleado)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_empleado", $datos["id_empleado"], PDO::PARAM_INT);
		$stmt->bindParam(":id_inventario", $datos["id_inventario"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":firma_mesa", $datos["firma_mesa"], PDO::PARAM_STR);
		$stmt->bindParam(":firma_empleado", $datos["firma_empleado"], PDO::PARAM_STR);
	
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
			
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*======================================
  =  MOSTRAR ULTIMO CÓDIGO DE ACTA     =
  ======================================*/
  
  static public function mdlMostrarUltimoCodigoActa($tabla, $item, $valor){

	$stmt = Conexion::conectar()->prepare("SELECT MAX(codigo) FROM $tabla");

	$stmt -> execute();

	return $stmt -> fetch();
	
	$stmt -> close();

	$stmt = null;

}

/*========================================
	=            ELIMINAR ACTA            =
	========================================*/
	
		static public function mdlBorrarActa($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		// $stmt -> close();

		$stmt = null;
	}

	

}