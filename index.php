<?php

require_once "controladores/operaciones.controlador.php";
require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/inventario.controlador.php";
require_once "controladores/empleados.controlador.php";
require_once "controladores/DID.controlador.php";
require_once "controladores/acta.controlador.php";
require_once "controladores/modulos.controlador.php";


require_once "modelos/operaciones.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/inventario.modelo.php";
require_once "modelos/empleados.modelo.php";
require_once "modelos/DID.modelo.php";
require_once "modelos/acta.modelo.php";
require_once "modelos/usuarios.modelo.php";
require_once "modelos/modulos.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();