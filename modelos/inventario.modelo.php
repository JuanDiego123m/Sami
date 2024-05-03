<?php

require_once "conexion.php";

class ModeloInventario{

	/*======================================
	=            MOSTRAR ITEMS           =
	======================================*/
	
	static public function mdlMostrarItems($tabla, $item, $valor){

		
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

	static public function mdlIngresarItem($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla ( id_empleado, tipoActivo, serial, estado, propietario, notas) VALUES (:id_empleado, :tipoActivo, :serial, :estado, :propietario, :notas)");

		$stmt->bindParam(":id_empleado", $datos["propietario"], PDO::PARAM_INT);
		$stmt->bindParam(":tipoActivo", $datos["tipoActivo"], PDO::PARAM_STR);
		$stmt->bindParam(":serial", $datos["serial"], PDO::PARAM_STR);
		$stmt->bindValue(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":propietario", $datos["propietario"], PDO::PARAM_STR);
		$stmt->bindValue(":notas", $datos["notas"], PDO::PARAM_STR);
	
		if($stmt->execute()){

			return "ok";

		}else{

			/*return "error";*/
			return $stmt->errorInfo();
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR Item
	=============================================*/
static public function mdlEditarInventario($tabla, $datos){

// Consulta SQL con marcadores de posición
$sql = "UPDATE inventario SET 
        id_empleado = :propietario,
        tipoActivo = :tipoActivo,
        serial = :serial,
        estado = :estado,
        propietario = :propietario,
        notas = :notas,
        ultima_modificacion = :ultima_modificacion
        WHERE idInventario = :idInventario";

// Preparar la consulta
$stmt = Conexion::conectar()->prepare($sql);

// Vincular valores a los marcadores de posición
$stmt->bindParam(':propietario', $datos["propietario"], PDO::PARAM_STR);
$stmt->bindParam(':tipoActivo', $datos["tipoActivo"], PDO::PARAM_STR);
$stmt->bindParam(':serial', $datos["serial"], PDO::PARAM_STR);
$stmt->bindParam(':estado', $datos["estado"], PDO::PARAM_STR);
$stmt->bindParam(':idEmpleado', $datos["idEmpleado"], PDO::PARAM_STR);
$stmt->bindParam(':notas', $datos["notas"], PDO::PARAM_STR);
$stmt->bindParam(':ultima_modificacion', $datos["ultima_modificacion"], PDO::PARAM_STR);
$stmt->bindParam(':idInventario', $datos["idInventario"], PDO::PARAM_STR);
	
		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}
	
		$stmt->close();
		$stmt = null;
	
	}

	/*======================================
	=           ELIMINAR ITEMS           =
	======================================*/
	static public function mdlBorrarInventario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idInventario = :idInventario");

		$stmt -> bindParam(":idInventario", $datos, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}

	/*==========================================
	=            ACTUALIZAR ITEM              =
	==========================================*/
	
	static public function mdlActualizarItem($tabla, $item1, $valor1, $item2, $valor2,$item3, $valor3){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1, $item2 = :$item2 WHERE $item3 = :$item3");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item3, $valor3, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}



		/*==========================================
	=   ACTUALIZAR ESTADO Y ASIGNADO CUANDO SE GUARDE UN ACTA =
	==========================================*/

	static public function mdlactualizarEstadoActivo($tabla, $datos) {

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = 'Asignado', propietario = :id_empleado WHERE id_inventario = :idInventario");

		$stmt->bindParam(":propietario", $datos["propietario"], PDO::PARAM_STR);
		$stmt->bindParam(":idInventario", $datos["idInventario"], PDO::PARAM_STR);
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}



}