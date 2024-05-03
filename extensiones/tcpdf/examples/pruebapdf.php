<?php

require_once "../../../controladores/acta.controlador.php";
require_once "../../../modelos/acta.modelo.php";

require_once "../../../controladores/empleados.controlador.php";
require_once "../../../modelos/empleados.modelo.php";

class imprimirActa{

public $codigo;

public function traerImpresionActa(){

// traer informacion de la cotizacion
$itemActa = 'codigo';
$valorActa = $this->codigo;
$respuestaActa = ControladorActa::ctrMostrarActa($itemActa, $valorActa);

if (isset($respuestaActa['fecha'])) {
  $fecha = substr($respuestaActa['fecha'], 0, -8);
}
$activo = $respuestaActa['id_inventario'];


// Traer informacion del empleado
$itemEmpleado = 'idEmpleado';
$valorEmpleado = $respuestaActa['id_empleado'];
$empleado = ControladorEmpleados::CtrMostrarEmpleados($itemEmpleado, $valorEmpleado);

// clase TCPDF

require_once('tcpdf_include.php');


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// ---------------------------------------------------------

$pdf->startPageGroup();

$pdf->AddPage();

$pdf->Ln(20);

// set some text to print
$bloque1 = <<<EOF

<p>La empresa Soluciones BPO hace entrega de Computador a $empleado el cual
debe ser usado exclusivamente como herramienta de trabajo, esta será responsabilidad del empleado
mientras se encuentre en la compañía y cualquier daño ó imperfecto no especificado en el apartado
"Condiciones funcionales del activo" y que no sea deterioro natural por uso de está será cobrado
al empleado.
</p>

<table style="border-collapse: collapse; border: 1px solid black;">
  <tr>
    <td style="width:200px; border: 1px solid black;">
      <div style="font-size:14px; text-align:center; line-height:15px;">
         Empleado
         <br>
      </div>
    </td>

    <td style="width:300px; border: 1px solid black;">
      <div style="font-size:14px; text-align:center; line-height:15px;">
        Activo
        <br>
      </div>
    </td>

    <td style="background-color:white; width:125px; border: 1px solid black;">
      <div style="font-size:14px; text-align:center; line-height:15px;">
        Fecha
        <br>
      </div>
    </td>
  </tr>
  
  <tr>
    <td style="border: 1px solid black;">$empleado<br></td>
    <td style="background-color:white; border: 1px solid black;">$activo <br></td>
    <td style="background-color:white; border: 1px solid black;">$fecha <br></td>
  </tr>
</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// Segundo bloque documento

$bloque2 = <<<EOF

<br><br>

<h4>Condiciones funcionales del activo: <br></h4>


<table style="border-collapse: collapse; border: 1px solid black;">
  <tr>
    <td style="width:210px; border: 1px solid black;">
      <div style="font-size:14px; text-align:center; line-height:15px;">
         Descripción
         <br>
      </div>
    </td>
    <td style="width:210px; border: 1px solid black;">
      <div style="font-size:14px; text-align:center; line-height:15px;">
        Estado
        <br>
      </div>
    </td>
    <td style="background-color:white; width:210px; border: 1px solid black;">
      <div style="font-size:14px; text-align:center; line-height:15px;">
        Observaciones
        <br>
      </div>
    </td>
  </tr>
  <tr>
    <td style="border: 1px solid black;">Nueva / Usada <br></td>
    <td style="background-color:white; border: 1px solid black;">Usado</td>
    <td style="background-color:white; border: 1px solid black;"></td>
  </tr>
  <tr>
    <td style="border: 1px solid black;">Teclado</td>
    <td style="background-color:white; border: 1px solid black;">Funciona correctamente, sin daños físicos</td>
    <td style="background-color:white; border: 1px solid black;"></td>
  </tr>
  <tr>
    <td style="border: 1px solid black;">Touch Pad</td>
    <td style="background-color:white; border: 1px solid black;">Funciona correctamente, sin daños físicos</td>
    <td style="background-color:white; border: 1px solid black;"></td>
  </tr>
  <tr>
    <td style="border: 1px solid black;">Cargador</td>
    <td style="background-color:white; border: 1px solid black;">Funciona correctamente, sin daños físicos</td>
    <td style="background-color:white; border: 1px solid black;"></td>
  </tr>
  <tr>
    <td style="border: 1px solid black;">Condiciones Físicas <br></td>
    <td style="background-color:white; border: 1px solid black;">En buenas condiciones físicas</td>
    <td style="background-color:white; border: 1px solid black;"></td>
  </tr>
</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// Tercer bloque documento

$bloque3 = <<<EOF

<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br>


<style>
.firma-linea {
  width: 40%; /* Anchura deseada para la línea de firma */
  border: none;
  border-top: 1px solid #000000; /* Color de la línea */
  margin: 10px auto; /* Margen superior e inferior, y centrado horizontalmente */
}
</style>

<hr class="firma-linea">
<p>Mesa de Servicios Soluciones BPO</p>




EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// Salida del archivo

$pdf->Output('cotizacion-'.$valorActa.'.pdf');

}

}

$cotizacion = new imprimirActa();
$cotizacion -> codigo = $_GET['codigo'];
$cotizacion -> traerImpresionActa();

?>