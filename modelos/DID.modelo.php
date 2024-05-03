<?php

require_once "conexion.php";

class ModeloDID{


	/*=====================================
	=            CREAR DID            =
	=====================================*/
	
	static public function mdlIngresarDID($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla ( id_cliente, did, operacion, troncales, proveedor, ciudad) VALUES ( :id_cliente, :did, :operacion, :troncales, :proveedor, :ciudad)");

		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":did", $datos["did"], PDO::PARAM_STR);
		$stmt->bindParam(":operacion", $datos["operacion"], PDO::PARAM_STR);
		$stmt->bindParam(":troncales", $datos["troncales"], PDO::PARAM_STR);
		$stmt->bindParam(":proveedor", $datos["proveedor"], PDO::PARAM_STR);
		$stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*========================================
	=            MOSTRAR DID            =
	========================================*/
		
	static public function mdlMostrarDID($tabla, $item, $valor){

		if($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY idDid DESC");
			
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}
	
	/*========================================
	=            MOSTRAR TODOS DID           =
	========================================*/
		
	static public function mdlMostrarTodosLosDID($tabla, $item, $valor){

		if($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY idDid DESC");
			
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

	/*=====================================
	=            EDITAR DID            =
	=====================================*/
	
	static public function mdlEditarDID($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_cliente = :id_cliente, did = :did, operacion = :operacion, troncales = :troncales, proveedor = :proveedor, ciudad = :ciudad  WHERE idDid = :idDid");

		$stmt->bindParam(":idDid", $datos["idDid"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":did", $datos["did"], PDO::PARAM_STR);
		$stmt->bindParam(":operacion", $datos["operacion"], PDO::PARAM_STR);
		$stmt->bindParam(":troncales", $datos["troncales"], PDO::PARAM_STR);
		$stmt->bindParam(":proveedor", $datos["proveedor"], PDO::PARAM_STR);
		$stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*========================================
	=            ELIMINAR DID            =
	========================================*/
	
	static public function mdlBorrarDID($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idDid = :idDid");

		$stmt -> bindParam(":idDid", $datos, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}

	/*==========================================
	=            ACTUALIZAR DID            =
	==========================================*/
	
	static public function mdlActualizarDID($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE idDid = :idDid");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":idDid", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
	
	
	
} 