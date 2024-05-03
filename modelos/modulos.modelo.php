<?php

require_once "conexion.php";

class ModeloModulos{


	/*=====================================
	=            CREAR MODULO            =
	=====================================*/
	
	static public function mdlIngresarModulo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, id_cliente, usuario, password, lic_cc, lic_pbx, redes, ip_servidor, operacion_cc) VALUES (:nombre, :id_cliente, :usuario, :password, :lic_cc, :lic_pbx, :redes, :ip_servidor, :operacion_cc)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":lic_cc", $datos["lic_cc"], PDO::PARAM_STR);
		$stmt->bindParam(":lic_pbx", $datos["lic_pbx"], PDO::PARAM_STR);
		$stmt->bindParam(":redes", $datos["redes"], PDO::PARAM_STR);
		$stmt->bindParam(":ip_servidor", $datos["ip_servidor"], PDO::PARAM_STR);
		$stmt->bindParam(":operacion_cc", $datos["operacion_cc"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*========================================
	=            MOSTRAR MODULO EN CLIENTES  =
	========================================*/
	
	
	static public function mdlMostrarModulos($tabla, $item, $valor){

		if($item != null){

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

	/*========================================
	=            MOSTRAR MODULO GENERAL      =
	========================================*/
	
	
	static public function mdlMostrarModulosb($tablab, $itemb, $valorb){

		if($itemb != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tablab WHERE $itemb = :$itemb");

			$stmt -> bindParam(":".$itemb, $valorb, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tablab");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=====================================
	=            EDITAR MODULO            =
	=====================================*/
	
	static public function mdlEditarModulo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, id_cliente = :id_cliente, usuario = :usuario, password = :password, lic_cc = :lic_cc, lic_pbx = :lic_pbx, redes = :redes, ip_servidor = :ip_servidor, operacion_cc = :operacion_cc WHERE id = :id");
		
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":lic_cc", $datos["lic_cc"], PDO::PARAM_STR);
		$stmt->bindParam(":lic_pbx", $datos["lic_pbx"], PDO::PARAM_STR);
		$stmt->bindParam(":redes", $datos["redes"], PDO::PARAM_STR);
		$stmt->bindParam(":ip_servidor", $datos["ip_servidor"], PDO::PARAM_STR);
		$stmt->bindParam(":operacion_cc", $datos["operacion_cc"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*========================================
	=            ELIMINAR MODULO            =
	========================================*/
	
	static public function mdlEliminarModulo($tabla, $datos){


		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*==========================================
	=            ACTUALIZAR MODULO            =
	==========================================*/
	
	static public function mdlActualizarModulo($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
	
	
	
} 