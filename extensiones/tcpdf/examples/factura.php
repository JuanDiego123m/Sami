<?php
require_once "../../../controladores/empleados.controlador.php";
require_once "../../../modelos/empleados.modelo.php";

require_once "../../../controladores/inventario.controlador.php";
require_once "../../../modelos/inventario.modelo.php";

require_once "../../../controladores/acta.controlador.php";
require_once "../../../modelos/acta.modelo.php";

class imprimirCotizacion{
public $codigo;

public function traerImpresionCotizacion(){

// traer informacion de la cotizacion
$item = 'codigo';
$valor = $this->codigo;
$respuestaActa = ControladorActa::ctrMostrarActa($item, $valor);

$fecha = substr($respuestaActa['fecha'],0,-8);
$equipo = $respuestaActa['id_inventario'];
$descripcion = $respuestaActa['descripcion'];

// Traer informacion del empleado
$itemEmpleado = 'idEmpleado';
$valorEmpleado = $respuestaActa['id_empleado'];
$respuestaEmpleado = ControladorEmpleados::CtrMostrarEmpleados($itemEmpleado, $valorEmpleado);

// clase TCPDF

require_once('tcpdf_include.php');


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// ---------------------------------------------------------


$pdf->startPageGroup();

$pdf->AddPage();

// Primer bloque documento

$bloque1 = <<<EOF

	<table>

		<tr>

			<td style="width:120px; border: 1px solid #fff;">

				<div style="font-size:10px; text-align:left; line-height:15px;">

					<br>
				
				</div>

			</td>


			<td style="background-color:white; border: 1px solid #fff; width:100px">

				<div style="font-size:10px; text-align:left; line-height:15px;">
					<br>
					<br>
				</div>

			</td>

			<td style="background-color:white; border: 1px solid #fff; width:180px">

				<div style="font-size:10px; text-align:left; line-height:15px;">

					

				</div>

			</td>

			<td style="background-color:white; border: 1px solid #fff; width:140px; font-size:1.4em; text-align:rigth;">
				<br>	
				<br>
				<br>N° 
			</td>

		</tr>

		<tr>

			<td style="background-color:white; border: 1px solid #fff; width:130px">

				<div style="font-size:10px; text-align:left; line-height:15px;">

					<br>
			
				</div>

			</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// Segundo bloque documento

$bloque2 = <<<EOF

	<table>

		<tr>

			<td style="width:540px"><img src="images/blanco1.png"></td>

		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="border: 1px solid #fff; background-color:white; width:390px">Facturar a:</td>

			<td style="border: 1px solid #fff; background-color:white; width:150px; text-align:rigth;">Fecha de la cotización: $fecha</td>

		</tr>



		<tr>

			<td style="border: 1px solid #fff; background-color:white; width:390px">$respuestaEmpleado[nombre]</td>

		</tr>

		<br>
		
		<tr>

			<td style="border: 1px solid #fff; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// Tercer bloque documento

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="border: 1px solid #fff; background-color:grey; color:white; width:540px;"><b>Descripción</b></td>

		</tr>

		<br>

		<tr>

			<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Producto</td>
			<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Cantidad</td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Unit.</td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>

		</tr>

		<br>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// Cuarto bloque documento

$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="border: 1px solid #fff; background-color:grey; color:white; width:540px;"><b>Observaciónes</b></td>

		</tr>

		<br>

		<tr>

			<td style="border: 1px solid #fff; background-color:white; width:540px;">Para el desarrollo de la solución, se tiene un estimado de  horas en las cuales se tendrán en cuenta sus respectivas pruebas.</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

// Salida del archivo

$pdf->Output('cotizacion-'.$valor.'.pdf');

}

}

$cotizacion = new imprimirCotizacion();
$cotizacion -> codigo = $_GET['codigo'];
$cotizacion -> traerImpresionCotizacion();

?>