<?php

require '../plugins/spout-master/src/Spout/Autoloader/autoload.php';

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;

// Conexión a la base de datos en localhost con valores por defecto
$servername = "localhost";
$username = "root"; // Usuario por defecto en la mayoría de las instalaciones locales
$password = ""; // Contraseña en blanco por defecto en muchas instalaciones locales
$dbname = "operacion-sami";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Crear un escritor para Excel
$writer = WriterEntityFactory::createXLSXWriter();

// Abrir un archivo de salida para escribir los datos
$writer->openToBrowser('datos.xlsx'); // El archivo se abrirá en el navegador y se descargará como "datos.xlsx"

// Establecer el tipo de contenido para el archivo Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="datos.xlsx"');

// Agregar una fila con el texto "Inventario"
$inventarioRow = WriterEntityFactory::createRow([
    WriterEntityFactory::createCell(''),
    WriterEntityFactory::createCell('Inventario SBPO', (new StyleBuilder())->setFontBold()->setFontSize(16)->build()), // Cambia el tamaño de la fuente aquí
]);

// Establecer el ancho de las celdas
$writer->addRow($inventarioRow);

// Consulta SQL para obtener los datos de la base de datos ordenados por id_empleado
$sql = "SELECT `id_empleado`, `tipoActivo`, `serial` FROM inventario ORDER BY `id_empleado` ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Encabezados del archivo Excel
    $headerRow = WriterEntityFactory::createRow([
        WriterEntityFactory::createCell('ID Del Empleado'),
        WriterEntityFactory::createCell('Tipo Del Activo'),
        WriterEntityFactory::createCell('Serial'),
    ]);

    $writer->addRow($headerRow);

    // Recorremos los resultados y los escribimos en el archivo Excel
    while ($row = $result->fetch_assoc()) {
        $dataRow = WriterEntityFactory::createRow([
            WriterEntityFactory::createCell($row["id_empleado"]),
            WriterEntityFactory::createCell($row["tipoActivo"]),
            WriterEntityFactory::createCell($row["serial"]),
        ]);
        $writer->addRow($dataRow);
    }
} else {
    echo "No se encontraron resultados en la base de datos.";
}

// Cerrar el archivo Excel
$writer->close();

// Cerrar la conexión a la base de datos
$conn->close();
?>
