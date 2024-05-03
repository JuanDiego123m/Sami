<?php

require 'vendor/autoload.php';
require 'conect.php';

//Uso de la librería y sus metodos
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

//Consulta de la base de datos
$consulta = "SELECT 
did.did, 
clientess.nombre AS id_cliente, 
operaciones.usuario AS operacion,   
did.troncales, 
did.proveedor,
did.ciudad 
FROM 
did
LEFT JOIN 
clientess ON did.id_cliente = clientess.idCliente
LEFT JOIN
operaciones ON did.operacion = operaciones.id";

//Resultado de la consulta
$resultado = $mysqli->query($consulta);

$excel = new Spreadsheet();

$hojaActiva = $excel->getActiveSheet(); //Trabajo sobre hoja activa.
$hojaActiva->setTitle('DID'); //Nombre de la hoja

$excel->getDefaultStyle()->getFont()->setName('Arial'); //Tipo de letra

$hojaActiva->getColumnDimension('B')->setWidth(15); // Dimensión de la columna
$hojaActiva->setCellValue('B2', 'DID'); // Nombre de las columnas y en que posición irán
$hojaActiva->getStyle('B2')->getFont()->setBold(true); // Establecer negrita para la celda B2

$hojaActiva->getColumnDimension('C')->setWidth(45);
$hojaActiva->setCellValue('C2', 'Cliente');
$hojaActiva->getStyle('C2')->getFont()->setBold(true); 

$hojaActiva->getColumnDimension('D')->setWidth(20);
$hojaActiva->setCellValue('D2', 'Operación');
$hojaActiva->getStyle('D2')->getFont()->setBold(true); 

$hojaActiva->getColumnDimension('E')->setWidth(10);
$hojaActiva->setCellValue('E2', 'Troncales');
$hojaActiva->getStyle('E2')->getFont()->setBold(true); 

$hojaActiva->getColumnDimension('F')->setWidth(20);
$hojaActiva->setCellValue('F2', 'Proveedor');
$hojaActiva->getStyle('F2')->getFont()->setBold(true); 

$hojaActiva->getColumnDimension('G')->setWidth(20);
$hojaActiva->setCellValue('G2', 'Ciudad');
$hojaActiva->getStyle('G2')->getFont()->setBold(true);

// Establecer alineación a la izquierda para todas las celdas de la columna C
$hojaActiva->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
$hojaActiva->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

$fila = 3; //Declaración de filas para el contenido 

//Traer los datos a través de un ciclo
while ($row = $resultado->fetch_assoc()) {
    $hojaActiva->setCellValue('B' .$fila, $row['did']);
    $hojaActiva->setCellValue('C' .$fila, $row['id_cliente']);
    $hojaActiva->setCellValue('D' .$fila, $row['operacion']);
    $hojaActiva->setCellValue('E' .$fila, $row['troncales']);
    $hojaActiva->setCellValue('F' .$fila, $row['proveedor']);
    $hojaActiva->setCellValue('G' .$fila, $row['ciudad']);
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
header('Content-Disposition: attachment;filename="DID_reporte.Xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx'); // El nombre de la variable $excel
$writer->save('php://output');
exit;