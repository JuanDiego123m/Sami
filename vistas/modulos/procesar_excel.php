<?php
header('Content-type: application/json');
$pdo = new PDO("mysql:dbname=operacion-sami;host=localhost", "root", "");

require '../plugins/SpreadsheetReader/spreadsheetReader.php';

if (isset($_FILES['excelFile'])) {
    $file = $_FILES['excelFile']['tmp_name'];

    $spreadsheet = new SpreadsheetReader($file);
    $sheets = $spreadsheet->Sheets();

    foreach ($sheets as $sheet) { 
        $spreadsheet->ChangeSheet($sheet);

        foreach ($spreadsheet as $row) {
            // Obtén los datos de cada columna del archivo Excel
            $title = $row['title'];
            $horario = $row['horario'];
            $id_empleado = $row['id_empleado'];
            $linea_trabajo = $row['lineatrabajo'];
            $descripcionmalla = $row['descripcionmalla'];
            $start = $row['start'];
            $end = $row['end'];
            $hora = $row['hora'];
            
            // Guarda los datos en la base de datos
            // Asumiendo que ya tienes una conexión a la base de datos MySQL establecida
            $stmt = $pdo->prepare("INSERT INTO `malla` (`title`, `hora`, `descripcionmalla`, `start`, `end`, `id_empleado`, `horario`, `linea_trabajo`) VALUES (:title,:hora,:descripcionmalla,:start,:end,:id_empleado,:horario, :linea_trabajo)");
            $stmt->bindParam(':title', $title);
            $stmt ->bindParam(':hora', $hora);
            $stmt->bindParam(':horario', $horario);
            $stmt->bindParam(':id_empleado', $id_empleado);
            $stmt->bindParam(':lineatrabajo', $linea_trabajo);
            $stmt->bindParam(':descripcionmalla', $descripcionmalla);
            $stmt->bindParam(':start', $start);
            $stmt->bindParam(':end', $end);
            
            $stmt->execute();
        }
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'No se cargó ningún archivo.']);
}
?>