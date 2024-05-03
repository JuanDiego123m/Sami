<?php

// require_once "conexion.php";

// class ModeloMalla{


// 	/*=====================================
// 	=            CREAR EMPLEADOS            =
// 	=====================================*/
	
// 	static public function mdlRegistrarMalla($tabla, $datos){

// 		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(empleado, evento, hora) VALUES (:empleado, :evento, :hora)");

// 		$stmt->bindParam(":empleado", $datos["idEmpleado"], PDO::PARAM_STR);
// 		$stmt->bindParam(":evento", $datos["evento"], PDO::PARAM_STR);
// 		$stmt->bindParam(":hora", $datos["hora"], PDO::PARAM_STR);
		 
		
		

// 		if($stmt->execute()){

// 			return "ok";

// 		}else{

// 			return "error";
		
// 		}

// 		// $stmt->close();
// 		$stmt = null;

// 	}
// } 