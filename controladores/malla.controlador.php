<?php

// class ControladorMalla {

//     static public function ctrAgregarEvento($datos) {
//         // Verificar que se hayan enviado todos los datos necesarios
//         if (isset($datos["title"]) && isset($datos["hora"]) && isset($datos["descripcionmalla"]) && isset($datos["start"]) && isset($datos["end"]) && isset($datos["nombres"]) && isset($datos["horario"])) {
            
//             // Iniciar la conexión PDO
//             $pdo = new PDO("mysql:dbname=operacion-sami;host=localhost", "root", "");
            
//             // Preparar la consulta SQL de inserción
//             $sentenciaSQL = $pdo->prepare("INSERT INTO `malla` (`title`,`hora`, `descripcionmalla`, `start`, `end`, `id_empleado`, `horario`) VALUES (:title,:hora,:descripcionmalla,:start,:end,:nombres,:horario)");
            
//             // Ejecutar la consulta con los datos proporcionados
//             $respuesta = $sentenciaSQL->execute(array(
//                 "title" => $datos['title'],
//                 "hora" => $datos['hora'],
//                 "descripcionmalla" => $datos['descripcionmalla'],
//                 "start" => $datos['start'],
//                 "end" => $datos['end'],
//                 "nombres" => $datos['nombres'],
//                 "horario" => $datos['horario']
//             ));
            
//             // Verificar el resultado de la operación
//             if ($respuesta) {
//                 // Alerta de éxito
//                 echo '<script>
//                         swal({
//                             type: "success",
//                             title: "¡Hecho!",
//                             text: "Evento creado correctamente.",
//                             showConfirmButton: true,
//                             confirmButtonText: "Cerrar"
//                         }).then(function(result) {
//                             if (result.value) {
//                                 window.location = "malla";
//                             }
//                         });
//                     </script>';
//             } else {
//                 // Alerta de error
//                 echo '<script>
//                         swal({
//                             type: "error",
//                             title: "¡Error!",
//                             text: "Hubo un error al crear el evento.",
//                             showConfirmButton: true,
//                             confirmButtonText: "Cerrar"
//                         }).then(function(result) {
//                             if (result.value) {
//                                 window.location = "crear-malla";
//                             }
//                         });
//                     </script>';
//             }
//         }
//         // Si no se enviaron todos los datos necesarios, devolver false
//         return false;
//     }

//     static public function ctrEliminarEvento($id) {
//         // Verificar que se haya proporcionado un ID válido
//         if(isset($id)) {
//             // Iniciar la conexión PDO
//             $pdo = new PDO("mysql:dbname=operacion-sami;host=localhost", "root", "");
            
//             // Preparar la consulta SQL de eliminación
//             $sentenciaSQL = $pdo->prepare("DELETE FROM malla WHERE ID=:ID");
            
//             // Ejecutar la consulta con el ID proporcionado
//             $respuesta = $sentenciaSQL->execute(array("ID" => $id));
            
//             // Verificar el resultado de la operación
//             if ($respuesta) {
//                 // Alerta de éxito
//                 echo '<script>
//                         swal({
//                             type: "success",
//                             title: "¡Hecho!",
//                             text: "Evento eliminado correctamente.",
//                             showConfirmButton: true,
//                             confirmButtonText: "Cerrar"
//                         }).then(function(result) {
//                             if (result.value) {
//                                 window.location = "crear-malla.php";
//                             }
//                         });
//                     </script>';
//             } else {
//                 // Alerta de error
//                 echo '<script>
//                         swal({
//                             type: "error",
//                             title: "¡Error!",
//                             text: "Hubo un error al eliminar el evento.",
//                             showConfirmButton: true,
//                             confirmButtonText: "Cerrar"
//                         }).then(function(result) {
//                             if (result.value) {
//                                 window.location = "crear-malla.php";
//                             }
//                         });
//                     </script>';
//             }
//         }
//         // Si no se proporcionó un ID válido, devolver false
//         return false;
//     }

//     static public function ctrModificarEvento($datos) {
//         // Verificar que se hayan enviado todos los datos necesarios
//         if (isset($datos["id"]) && isset($datos["title"]) && isset($datos["hora"]) && isset($datos["descripcionmalla"]) && isset($datos["start"]) && isset($datos["end"]) && isset($datos["nombres"]) && isset($datos["horario"])) {
            
//             // Iniciar la conexión PDO
//             $pdo = new PDO("mysql:dbname=operacion-sami;host=localhost", "root", "");
            
//             // Preparar la consulta SQL de modificación
//             $sentenciaSQL = $pdo->prepare("UPDATE malla SET 
//                 title=:title,
//                 hora=:hora,
//                 descripcionmalla=:descripcionmalla,
//                 start=:start,
//                 end=:end,
//                 id_empleado=:nombres,
//                 horario=:horario
//                 WHERE ID=:ID
//             ");
            
//             // Ejecutar la consulta con los datos proporcionados
//             $respuesta = $sentenciaSQL->execute(array(
//                 "ID" => $datos['id'],
//                 "title" => $datos['title'],
//                 "hora" => $datos['hora'],
//                 "descripcionmalla" => $datos['descripcionmalla'],
//                 "start" => $datos['start'],
//                 "end" => $datos['end'],
//                 "nombres" => $datos['nombres'],
//                 "horario" => $datos['horario']
//             ));
            
//             // Verificar el resultado de la operación
//             if ($respuesta) {
//                 // Alerta de éxito
//                 echo '<script>
//                         swal({
//                             type: "success",
//                             title: "¡Hecho!",
//                             text: "Evento modificado correctamente.",
//                             showConfirmButton: true,
//                             confirmButtonText: "Cerrar"
//                         }).then(function(result) {
//                             if (result.value) {
//                                 window.location = "malla";
//                             }
//                         });
//                     </script>';
//             } else {
//                 // Alerta de error
//                 echo '<script>
//                         swal({
//                             type: "error",
//                             title: "¡Error!",
//                             text: "Hubo un error al modificar el evento.",
//                             showConfirmButton: true,
//                             confirmButtonText: "Cerrar"
//                         }).then(function(result) {
//                             if (result.value) {
//                                 window.location = "crear-malla";
//                             }
//                         });
//                     </script>';
//             }
//         }
//         // Si no se enviaron todos los datos necesarios, devolver false
//         return false;
//     }

//     static public function ctrObtenerEventos() {
//         // Iniciar la conexión PDO
//         $pdo = new PDO("mysql:dbname=operacion-sami;host=localhost", "root", "");
        
//         // Preparar la consulta SQL de selección
//         $sentenciaSQL = $pdo->prepare("SELECT * FROM malla");
        
//         // Ejecutar la consulta
//         $sentenciaSQL->execute();
        
//         // Obtener los resultados en un arreglo asociativo
//         $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        
//         // Devolver los resultados
//         return $resultado;
//     }

// }
class ControladorMalla {

        static public function ctrCargaMasivaItems() {
            if (isset($_FILES['excelFile'])) {
                require '../plugins/SpreadsheetReader/spreadsheetReader.php';
                $pdo = new PDO("mysql:dbname=operacion-sami;host=localhost", "root", "");
                date_default_timezone_set('America/Bogota');
                
                $file = $_FILES['excelFile']['tmp_name'];
                $spreadsheet = new SpreadsheetReader($file);
                $sheets = $spreadsheet->Sheets();
                
                foreach ($sheets as $sheet) { 
                    $spreadsheet->ChangeSheet($sheet);
                    
                    foreach ($spreadsheet as $row) {
                        $title = $row['title'];
                        $horario = $row['horario'];
                        $id_empleado = $row['id_empleado'];
                        $linea_trabajo = $row['lineatrabajo'];
                        $descripcionmalla = $row['descripcionmalla'];
                        $start = $row['start'];
                        $end = $row['end'];
                        $hora = $row['hora'];
                        
                        $stmt = $pdo->prepare("INSERT INTO `malla` (`title`, `hora`, `descripcionmalla`, `start`, `end`, `id_empleado`, `horario`, `linea_trabajo`) VALUES (:title,:hora,:descripcionmalla,:start,:end,:id_empleado,:horario, :linea_trabajo)");
                        $stmt->bindParam(':title', $title);
                        $stmt->bindParam(':hora', $hora);
                        $stmt->bindParam(':horario', $horario);
                        $stmt->bindParam(':id_empleado', $id_empleado);
                        $stmt->bindParam(':linea_trabajo', $linea_trabajo);
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
        }
    }
    
    ControladorMalla::ctrCargaMasivaItems();
    
?>
