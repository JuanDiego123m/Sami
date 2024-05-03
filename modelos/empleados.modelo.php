<?php

require_once "conexion.php";

class ModeloEmpleados{


	/*=====================================
	=            CREAR EMPLEADOS            =
	=====================================*/
	
	static public function mdlRegistrarEmpleado($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, documento, telefono, area, cargo, estado) VALUES (:nombre, :documento,:telefono, :area, :cargo, :estado)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":area", $datos["area"], PDO::PARAM_STR);
		$stmt->bindParam(":cargo", $datos["cargo"], PDO::PARAM_STR);
		$stmt->bindValue(":estado", 1 , PDO::PARAM_INT);
		 
		
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*========================================
	=            MOSTRAR EMPLEADOS            =
	========================================*/
	
	
	static public function mdlMostrarEmpleados($tabla, $item, $valor){

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

	/*=====================================
	=            EDITAR EMPLEADO            =
	=====================================*/
	
	static public function mdlEditarEmpleado($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, documento = :documento, telefono = :telefono, area = :area, cargo = :cargo WHERE idEmpleado = :idEmpleado");

		$stmt->bindParam(":idEmpleado", $datos["idEmpleado"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":area", $datos["area"], PDO::PARAM_STR);
		$stmt->bindParam(":cargo", $datos["cargo"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*========================================
	=            ELIMINAR EMPLEADO            =
	========================================*/
	static public function mdlBorrarEmpleado($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idEmpleado = :idEmpleado");

		$stmt -> bindParam(":idEmpleado", $datos, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}
	/*==========================================
	=            ACTUALIZAR EMPLEADO            =
	==========================================*/
	
	static public function mdlActualizarEmpleado($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

		/*==========================================
	=    VERIFICACIÓN SI EL EMPLEADO EXISTE    =
	==========================================*/


	static public function verificarExistenciaEmpleado($tabla, $nombre){
		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE nombre = :nombre");
		$stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
		$stmt->execute();
		$count = $stmt->fetchColumn();
		return ($count > 0);
	}
	
	
	
	
} 