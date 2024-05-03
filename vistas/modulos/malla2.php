<?php

header('Content-type: application/json');
$pdo = new PDO("mysql:dbname=operacion-sami;host=localhost", "root", "");

$accion = (isset($_GET['accion'])) ? $_GET['accion'] : 'leer';
switch ($accion) {
    case 'agregar':
        // Instrucción de agregado
        $sentenciaSQL = $pdo->prepare("INSERT INTO `malla` (`title`,`hora`, `descripcionmalla`, `start`, `end`, `id_empleado`, `horario`) VALUES (:title,:hora,:descripcionmalla,:start,:end,:nombres,:horario)");

        $respuesta = $sentenciaSQL->execute(array(
            "title" => $_POST['title'],
            "hora" => $_POST['hora'],
            "descripcionmalla" => $_POST['descripcionmalla'],
            "start" => $_POST['start'],
            "end" => $_POST['end'],
            "horario" => $_POST['horario'],
            "nombres" => $_POST['nombres']
        ));
         
        echo json_encode($respuesta);
    break;
    case 'eliminar':
        // Instrucción de eliminar
        $respuesta = false;
        if(isset($_POST['id'])) {
            $sentenciaSQL = $pdo->prepare("DELETE FROM malla WHERE ID=:ID");
            $respuesta = $sentenciaSQL->execute(array("ID" => $_POST['id']));
        }
        echo json_encode($respuesta);
    break;        
    case 'modificar':
        // Instrucción de modificar
        $sentenciaSQL = $pdo->prepare("UPDATE malla SET 
        title=:title,
        hora=:hora,
        descripcionmalla=:descripcionmalla,
        start=:start,
        end=:end,
        id_empleado=:nombres,
        horario=:horario
        WHERE ID=:ID
        ");
        $respuesta = $sentenciaSQL->execute(array(
            "ID" => $_POST['id'],
            "title" => $_POST['title'],
            "descripcionmalla" => $_POST['descripcionmalla'],
            "start" => $_POST['start'],
            "end" => $_POST['end'],
            "horario" => $_POST['horario'],
            "nombres" => $_POST['nombres'],
            "hora" => $_POST['hora']
        ));
        echo json_encode($respuesta);
    break;    
        
    default:
        $sentenciaSQL = $pdo->prepare("SELECT * FROM malla");

        // Ejecutar la sentencia SQL
        $sentenciaSQL->execute();

        // Obtener los resultados en un arreglo asociativo
        $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

        // Enviar los resultados como JSON
        echo json_encode($resultado);
    break;
}
// header('Content-type: application/json');
// $pdo = new PDO("mysql:dbname=operacion-sami;host=localhost", "root", "");

// $accion = (isset($_GET['accion'])) ? $_GET['accion'] : 'leer';
// switch ($accion) {
//     case 'agregar':
//         // Instrucción de agregado
//         $sentenciaSQL = $pdo->prepare("INSERT INTO `malla` (`title`, `descripcionmalla`, `start`, `end`, `id_empleado`, `horario`, `linea_trabajo`) VALUES (:title,:descripcionmalla,:start,:end,:nombres,:horario,:lineatrabajo)");

//         $respuesta = $sentenciaSQL->execute(array(
//             "title" => $_POST['title'],
//             "descripcionmalla" => $_POST['descripcionmalla'],
//             "start" => $_POST['start'],
//             "end" => $_POST['end'],
//             "horario" => $_POST['horario'],
//             "nombres" => $_POST['nombres'],
//             "lineatrabajo" => $_POST['lineatrabajo']
//         ));
        
//         echo json_encode($respuesta);
//         break;
//     case 'eliminar':
//         // Instrucción de eliminar
//         $respuesta=false;
//         if(isset($_POST[ 'id' ])){
//             $sentenciaSQL= $pdo->prepare("DELETE FROM malla WHERE ID=:ID");
//             $respuesta= $sentenciaSQL->execute(array("ID"=>$_POST['id']));
//             }
//             echo json_encode($respuesta);
//         break;
//         case 'modificar':
//             // Instrucción de modificar
//             $sentenciaSQL = $pdo->prepare("UPDATE malla SET 
//             title=:title,
//             descripcionmalla=:descripcionmalla,
//             start=:start,
//             end=:end,
//             id_empleado=:nombres,
//             horario=:horario,
//             linea_trabajo=:lineatrabajo
//             WHERE ID=:ID
//             ");
//             $respuesta = $sentenciaSQL->execute(array(
//                 "ID" => $_POST['id'],
//                 "title" => $_POST['title'],
//                 "descripcionmalla" => $_POST['descripcionmalla'],
//                 "start" => $_POST['start'],
//                 "end" => $_POST['end'],
//                 "horario" => $_POST['horario'],
//                 "nombres" => $_POST['nombres'],
//                 "lineatrabajo" => $_POST['lineatrabajo']
//             ));
//             echo json_encode($respuesta);
//             break;
        
//     default:
//         $sentenciaSQL = $pdo->prepare("SELECT * FROM malla");

//         // Ejecutar la sentencia SQL
//         $sentenciaSQL->execute();

//         // Obtener los resultados en un arreglo asociativo
//         $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

//         // Enviar los resultados como JSON
//         echo json_encode($resultado);
//         break;
// }
?>
