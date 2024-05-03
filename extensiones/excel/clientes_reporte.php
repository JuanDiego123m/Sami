<?php

require 'vendor/autoload.php';
require 'conect.php';

//Uso de la librería y sus metodos
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

//Consulta de la base de datos
$consulta = "SELECT 
clientess.nombre, 
clientess.nit
FROM
clientess";

//Resultado de la consulta
$resultado = $mysqli->query($consulta);

$excel = new Spreadsheet();

$hojaActiva = $excel->getActiveSheet(); //Trabajo sobre hoja activa.
$hojaActiva->setTitle('Clientes'); //Nombre de la hoja

$excel->getDefaultStyle()->getFont()->setName('Arial'); //Tipo de letra

$hojaActiva->getColumnDimension('B')->setWidth(78); // Dimensión de la columna
$hojaActiva->setCellValue('B2', 'Cliente'); // Nombre de las columnas y su información
$hojaActiva->getStyle('B2')->getFont()->setBold(true); // Establecer negrita para la celda B2

$hojaActiva->getColumnDimension('C')->setWidth(15);
$hojaActiva->setCellValue('C2', 'Nit');
$hojaActiva->getStyle('C2')->getFont()->setBold(true); 
// Establecer alineación a la izquierda para todas las celdas de la columna C
$hojaActiva->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

// Aplicar formato de texto a toda la columna C para asegurarse de que los NIT se muestren correctamente
$hojaActiva->getStyle('C')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

$fila = 3; //Declaración de filas para el contenido 

//Traer los datos a través de un ciclo
while ($row = $resultado->fetch_assoc()) {
    $hojaActiva->setCellValue('B' .$fila, $row['nombre']);
    $hojaActiva->setCellValue('C' .$fila, "'" . $row['nit']); //Utilización de las comilla simple para que el NIT sea tratato como texto
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
header('Content-Disposition: attachment;filename="Clientes_reporte.Xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx'); // El nombre de la variable $excel
$writer->save('php://output');
exit;