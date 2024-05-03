<?php

class Conexion{

		/*==========================================
	=            CONEXIÓN A LA BASE DE DATOS POR METODO PDO   =
	==========================================*/

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=operacion-sami",
			            "root",
			            "");

		$link->exec("set names utf8");

		return $link;

	}

}