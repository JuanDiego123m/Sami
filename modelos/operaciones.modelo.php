<?php

require_once "conexion.php";

class ModeloOperaciones{


	/*=====================================
	=            CREAR OPERACIONES            =
	=====================================*/
	
	static public function mdlRegistrarOperacion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_cliente, usuario, password) VALUES (:id_cliente, :usuario,:password)");

		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);

	
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*========================================
	=            MOSTRAR OPERACION            =
	========================================*/
	
	
	static public function mdlMostrarOperacion($tabla, $item, $valor){

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

	/*========================================
	=            MOSTRAR OPERACION   2         =
	========================================*/
		
	static public function mdlMostrarOperacionb($tablab, $itemb, $valorb){

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
	=            EDITAR OPERACION            =
	=====================================*/
	
	static public function mdlEditarOperacion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_cliente = :id_cliente, usuario = :usuario, password = :password WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["idCliente"], PDO::PARAM_INT);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);


		if($stmt->execute()){

            return "ok";

        }else{

            $error = $stmt->errorInfo();
            return "error: " . $error[2];
			
        }

		$stmt->close();
		$stmt = null;

	}


	/*========================================
	=            ELIMINAR OPERACION            =
	========================================*/
	static public function mdlBorrarOperacion($tabla, $datos){

	$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

	$stmt -> bindParam(":id", $datos, PDO::PARAM_STR);

	if($stmt -> execute()){

		return "ok";
	
	}else{

		return "error";	

	}

	$stmt -> close();

	$stmt = null;
}



	/*==========================================
	=            ACTUALIZAR OPERACIONES            =
	==========================================*/
	
	static public function mdlActualizarOperacion($tabla, $item1, $valor1, $item2, $valor2){

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
	=    VERIFICACIÓN SI LA OPERACION EXISTE    =
	==========================================*/

    static public function verificarExistenciaOperacion($tabla, $usuario){
		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE usuario = :usuario");
		$stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
		$stmt->execute();
		$count = $stmt->fetchColumn();
		return ($count > 0);
	}


	
} 

