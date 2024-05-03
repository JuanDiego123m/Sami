<?php

require 'vendor/autoload.php';
require 'conect.php';

//Uso de la librería y sus metodos
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

//Consulta de la base de datos
$consulta = "SELECT 
empleados.nombre AS id_empleado,
inventario.tipoActivo, 
inventario.serial, 
inventario.estado, 
empleados.nombre AS propietario, 
inventario.notas, 
inventario.ultima_modificacion 
FROM 
inventario
LEFT JOIN 
empleados ON inventario.id_empleado = empleados.idEmpleado";


//Resultado de la consulta
$resultado = $mysqli->query($consulta);

$excel = new Spreadsheet();

$hojaActiva = $excel->getActiveSheet(); //Trabajo sobre hoja activa.
$hojaActiva->setTitle('Inventario'); //Nombre de la hoja

$excel->getDefaultStyle()->getFont()->setName('Arial'); //Tipo de letra

$hojaActiva->getColumnDimension('B')->setWidth(35);
$hojaActiva->setCellValue('B2', 'Empleado');
$hojaActiva->getStyle('B2')->getFont()->setBold(true);  

$hojaActiva->getColumnDimension('C')->setWidth(25); // Dimensión de la columna
$hojaActiva->setCellValue('C2', 'Tipo de Activo'); // Nombre de las columnas y su información
$hojaActiva->getStyle('C2')->getFont()->setBold(true); // Establecer negrita para la celda B2

$hojaActiva->getColumnDimension('D')->setWidth(20);
$hojaActiva->setCellValue('D2', 'Serial');
$hojaActiva->getStyle('D2')->getFont()->setBold(true); 

$hojaActiva->getColumnDimension('E')->setWidth(10);
$hojaActiva->setCellValue('E2', 'Estado');
$hojaActiva->getStyle('E2')->getFont()->setBold(true); 

$hojaActiva->getColumnDimension('F')->setWidth(35);
$hojaActiva->setCellValue('F2', 'Propietario');
$hojaActiva->getStyle('F2')->getFont()->setBold(true); 

$hojaActiva->getColumnDimension('G')->setWidth(10);
$hojaActiva->setCellValue('G2', 'Notas');
$hojaActiva->getStyle('G2')->getFont()->setBold(true); 

$hojaActiva->getColumnDimension('H')->setWidth(20);
$hojaActiva->setCellValue('H2', 'Ultima Modificacion');
$hojaActiva->getStyle('H2')->getFont()->setBold(true);


$fila = 3; //Declaración de filas para el contenido 

//Traer los datos a través de un ciclo
while ($row = $resultado->fetch_assoc()) {
    $hojaActiva->setCellValue('B' .$fila, $row['propietario']);
    $hojaActiva->setCellValue('C' .$fila, $row['tipoActivo']);
    $hojaActiva->setCellValue('D' .$fila, $row['serial']);
    $hojaActiva->setCellValue('E' .$fila, $row['estado']);
    $hojaActiva->setCellValue('F' .$fila, $row['propietario']);
    $hojaActiva->setCellValue('G' .$fila, $row['notas']);
    $hojaActiva->setCellValue('H' .$fila, $row['ultima_modificacion']);
    $fila++;
}

// Agregar bordes a las celdas
$lastRow = $hojaActiva->getHighestRow(); // Obtener la última fila con datos
$lastColumn = $hojaActiva->getHighestColumn(); // Obtener la última columna con datos

$range = 'B2:' . $lastColumn . $lastRow; // Rango de celdas desde B2 hasta la última fila y columna

$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Establecer el estilo de borde
            'color' => ['argb' => '000000'], // Color del borde, puedes cambiarlo a tu preferencia
        ],
    ],
];

$hojaActiva->getStyle($range)->applyFromArray($styleArray);

$excel->getProperties()->setCreator("Soluciones B.P.O"); //Creador del Excel

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Inventario_reporte.Xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx'); // El nombre de la variable $excel
$writer->save('php://output');
exit;